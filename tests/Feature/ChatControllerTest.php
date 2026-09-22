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
                 ->with(Mockery::any(), 'what projects has ODDS built?')
                 ->andReturn('ODDS has built AVONIC, MoneySense, THEODORE, and more.');
        });

        $response = $this->postJson('/api/chat', [
            'message' => 'what projects has ODDS built?',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'reply' => 'ODDS has built AVONIC, MoneySense, THEODORE, and more.',
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
                     return str_contains($prompt, 'You are Lorenzo') &&
                            str_contains($prompt, 'AVONIC') &&
                            str_contains($prompt, 'can only help with ODDS-related questions');
                 }), 'what projects has ODDS built?')
                 ->andReturn('Here are our projects.');
        });

        $response = $this->postJson('/api/chat', [
            'message' => 'what projects has ODDS built?',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'reply' => 'Here are our projects.',
                 ]);
    }
}
