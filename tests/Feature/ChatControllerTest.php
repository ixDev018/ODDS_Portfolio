<?php

namespace Tests\Feature;

use App\Services\GroqService;
use Mockery;
use Tests\TestCase;

class ChatControllerTest extends TestCase
{
    /**
     * Test validation on the chat API endpoint.
     */
    public function test_chat_requires_message_validation(): void
    {
        $response = $this->postJson('/api/chat', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['message']);
    }

    /**
     * Test successful chat response from GroqService.
     */
    public function test_chat_returns_successful_reply(): void
    {
        $this->mock(GroqService::class, function ($mock) {
            $mock->shouldReceive('chat')
                 ->once()
                 ->with(Mockery::any(), 'what is Simula?')
                 ->andReturn('Simula is the simulation framework built by ODDS.');
        });

        $response = $this->postJson('/api/chat', [
            'message' => 'what is Simula?',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'reply' => 'Simula is the simulation framework built by ODDS.',
                 ]);
    }

    /**
     * Test that system prompt is built and passed properly to the GroqService.
     */
    public function test_chat_passes_correct_system_prompt_to_groq(): void
    {
        $this->mock(GroqService::class, function ($mock) {
            $mock->shouldReceive('chat')
                 ->once()
                 ->with(Mockery::on(function ($prompt) {
                     return str_contains($prompt, 'You are the ODDS assistant') &&
                            str_contains($prompt, 'Simula') &&
                            str_contains($prompt, 'I can only help with ODDS questions');
                 }), 'what is Simula?')
                 ->andReturn('Simula is a framework.');
        });

        $response = $this->postJson('/api/chat', [
            'message' => 'what is Simula?',
        ]);

        $response->assertStatus(200);
    }
}
