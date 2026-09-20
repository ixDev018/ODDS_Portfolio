<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SelfPing extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'app:self-ping';

    /**
     * The console command description.
     */
    protected $description = 'Pings the application\'s own /ping endpoint to prevent Render free-tier spin-down';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $url = rtrim(config('app.url'), '/') . '/ping';

        try {
            $context = stream_context_create([
                'http' => [
                    'method'  => 'GET',
                    'timeout' => 10,
                    'ignore_errors' => true,
                ],
                'ssl' => [
                    'verify_peer'      => false,
                    'verify_peer_name' => false,
                ],
            ]);

            $response = @file_get_contents($url, false, $context);

            if ($response !== false) {
                $this->info("[self-ping] ✓ OK → {$url}");
                return Command::SUCCESS;
            }

            $this->warn("[self-ping] ✗ No response from {$url}");
            return Command::FAILURE;

        } catch (\Throwable $e) {
            $this->error("[self-ping] ✗ Error: " . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
