<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\OddsWork;
use Tests\TestCase;

class OurWorkTest extends TestCase
{
    use RefreshDatabase;

    public function test_our_work_page_loads_successfully_without_records(): void
    {
        $response = $this->get('/our-work');
        $response->assertStatus(200);
        $response->assertSee('Every System We Build.');
        $response->assertSee('Projects Accomplished');
        $response->assertSee('Want to see yours here?');
    }

    public function test_our_work_page_displays_active_database_records(): void
    {
        OddsWork::create([
            'title' => 'Alpha Sentinel System',
            'slug' => 'alpha-sentinel-system',
            'category' => 'Defense AI',
            'year' => '2025',
            'client' => 'CyberCorp',
            'role' => 'Principal Architect',
            'description' => 'Autonomous cybersecurity threat detection engine.',
            'tech_stack' => ['Rust', 'PyTorch', 'eBPF'],
            'is_active' => true,
            'sort_order' => 1,
        ]);

        OddsWork::create([
            'title' => 'Beta Inactive Project',
            'slug' => 'beta-inactive-project',
            'category' => 'Legacy Web',
            'year' => '2021',
            'is_active' => false,
            'sort_order' => 2,
        ]);

        $response = $this->get('/our-work');
        $response->assertStatus(200);
        $response->assertSee('Alpha Sentinel System');
        $response->assertSee('Defense AI');
        $response->assertSee('2025');
        $response->assertDontSee('Beta Inactive Project');
    }

    public function test_navbar_contains_our_work_link(): void
    {
        $response = $this->get('/our-work');
        $response->assertStatus(200);
        $expectedLink = route('portfolio.our-work');
        $response->assertSee($expectedLink);
    }
}