<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class GroqService
{
    /**
     * Send chat prompt and history to Groq API.
     *
     * @param string $systemPrompt
     * @param string|array $userMessageOrHistory
     * @return string
     * @throws Exception
     */
    public function chat(string $systemPrompt, string|array $userMessageOrHistory): string
    {
        $apiKey = config('services.groq.key');

        if (empty($apiKey)) {
            Log::error('Groq API Key is not set in config/services.php');
            throw new Exception('Groq API configuration missing.');
        }

        $configuredModel = config('services.groq.model', 'openai/gpt-oss-120b');
        $modelsToTry = array_unique(array_filter([
            $configuredModel,
            'openai/gpt-oss-120b',
            'openai/gpt-oss-20b',
            'qwen/qwen3.8-27b',
            'groq/compound-mini',
        ]));

        // Build messages payload
        $messagesPayload = [
            ['role' => 'system', 'content' => $systemPrompt],
        ];

        if (is_array($userMessageOrHistory)) {
            foreach ($userMessageOrHistory as $msg) {
                if (!empty($msg['role']) && isset($msg['content'])) {
                    $messagesPayload[] = [
                        'role' => $msg['role'],
                        'content' => (string)$msg['content'],
                    ];
                }
            }
        } else {
            $messagesPayload[] = [
                'role' => 'user',
                'content' => (string)$userMessageOrHistory,
            ];
        }

        $lastException = null;

        foreach ($modelsToTry as $model) {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
            ])->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => $model,
                'messages' => $messagesPayload,
                'temperature' => 0.3,
                'max_tokens' => 500,
            ]);

            if ($response->failed()) {
                $errorMsg = $response->body();
                Log::warning("Groq API Request failed with model {$model}", [
                    'status' => $response->status(),
                    'error' => $errorMsg,
                ]);

                // If 404 / model not found, try the next model in the list
                if ($response->status() === 404) {
                    continue;
                }

                throw new Exception('Failed to connect to the assistant service.');
            }

            $data = $response->json();
            $reply = $data['choices'][0]['message']['content'] ?? null;

            if ($reply !== null) {
                return $reply;
            }

            Log::error('Groq API response did not contain choices.message.content', ['response' => $data]);
        }

        throw new Exception('Failed to get a response from any available assistant model.');
    }
}
