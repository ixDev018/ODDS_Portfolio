<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\OddsService;
use App\Models\User;
use Tests\TestCase;

class ServicesCmsTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_displays_services_cards_and_modal(): void
    {
        OddsService::create([
            'name' => "Custom Enterprise\nDevelopment",
            'slug' => 'custom-enterprise-development',
            'tagline' => 'Scalable to the moon',
            'description' => 'Bespoke enterprise software engineered from first principles.',
            'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polyline points="16 18 22 12 16 6"></polyline></svg>',
            'body_content' => [
                ['type' => 'heading2', 'content' => 'High-Velocity Architecture'],
                ['type' => 'paragraph', 'content' => 'We engineer custom systems tailored to your needs.']
            ],
            'features' => ['High Concurrency', 'Zero Downtime'],
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Custom Enterprise');
        $response->assertSee('Development');
        $response->assertSee('service-modal');
        $response->assertSee('odds-services-data');
    }

    public function test_admin_services_index_requires_auth_or_loads_for_admin(): void
    {
        $response = $this->withSession(['odds_admin_logged_in' => true])->get('/admin/services');
        $response->assertStatus(200);
        $response->assertSee('Studio Services');
        $response->assertSee('Add Service');
    }

    public function test_admin_can_create_service_with_notion_blocks(): void
    {
        $payload = [
            'name' => 'AI Automation Pipelines',
            'tagline' => 'Autonomous. Real-Time.',
            'description' => 'High-throughput LLM pipelines and autonomous workflows.',
            'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/></svg>',
            'body_content' => json_encode([
                ['type' => 'heading2', 'content' => 'Autonomous Workflows'],
                ['type' => 'callout', 'content' => 'Powered by custom telemetry agents.']
            ]),
            'features' => 'LLM Workflows, Embeddings, Real-Time Telemetry',
            'action_btn_text' => "Let's Build",
            'action_btn_url' => '#cta',
            'is_active' => '1',
        ];

        $response = $this->withSession(['odds_admin_logged_in' => true])
            ->post('/admin/services/store', $payload);

        $response->assertRedirect(route('odds.admin.services.index'));

        $this->assertDatabaseHas('odds_services', [
            'name' => 'AI Automation Pipelines',
            'tagline' => 'Autonomous. Real-Time.',
        ]);

        $service = OddsService::where('name', 'AI Automation Pipelines')->first();
        $this->assertNotNull($service);
        $this->assertCount(2, $service->body_content);
        $this->assertCount(3, $service->features);
    }

    public function test_admin_can_update_service(): void
    {
        $service = OddsService::create([
            'name' => 'Legacy Service',
            'slug' => 'legacy-service',
            'tagline' => 'Old tagline',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $response = $this->withSession(['odds_admin_logged_in' => true])
            ->post("/admin/services/update/{$service->id}", [
                'name' => 'Next-Gen Cloud Architecture',
                'tagline' => 'Zero Downtime',
                'description' => 'Updated description for cloud architecture.',
                'is_active' => '1',
            ]);

        $response->assertRedirect(route('odds.admin.services.index'));
        $this->assertDatabaseHas('odds_services', [
            'id' => $service->id,
            'name' => 'Next-Gen Cloud Architecture',
            'tagline' => 'Zero Downtime',
        ]);
    }

    public function test_admin_can_delete_service(): void
    {
        $service = OddsService::create([
            'name' => 'Service To Delete',
            'slug' => 'service-to-delete',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $response = $this->withSession(['odds_admin_logged_in' => true])
            ->post("/admin/services/delete/{$service->id}");

        $response->assertRedirect(route('odds.admin.services.index'));
        $this->assertDatabaseMissing('odds_services', [
            'id' => $service->id,
        ]);
    }
}
