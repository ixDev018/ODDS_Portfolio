<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class GroqService
{
    /**
     * Send chat prompt to Groq API.
     *
     * @param string $systemPrompt
     * @param string $userMessage
     * @return string
     * @throws Exception
     */
    public function chat(string $systemPrompt, string $userMessage): string
    {
        $apiKey = config('services.groq.key');

        if (empty($apiKey)) {
            Log::error('Groq API Key is not set in config/services.php');
            throw new Exception('Groq API configuration missing.');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
        ])->post('https://api.groq.com/openai/v1/chat/completions', [
            'model' => 'llama-3.1-8b-instant',
            'messages' => [
                ['role' => 'system', 'content' => $systemPrompt],
                ['role' => 'user', 'content' => $userMessage],
            ],
            'temperature' => 0.3,
            'max_tokens' => 500,
        ]);

        if ($response->failed()) {
            $errorMsg = $response->body();
            Log::error('Groq API Request failed', [
                'status' => $response->status(),
                'error' => $errorMsg,
            ]);
            throw new Exception('Failed to connect to the assistant service.');
        }

        $data = $response->json();
        $reply = $data['choices'][0]['message']['content'] ?? null;

        if ($reply === null) {
            Log::error('Groq API response did not contain choices.message.content', ['response' => $data]);
            throw new Exception('Invalid response received from assistant service.');
        }

        return $reply;
    }
}
