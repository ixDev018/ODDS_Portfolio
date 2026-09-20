<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/*
|--------------------------------------------------------------------------
| Scheduled Tasks
|--------------------------------------------------------------------------
*/

// Self-ping every 5 minutes to prevent Render free-tier spin-down.
// Runs entirely inside the container — no external uptime service needed.
Schedule::command('app:self-ping')->everyFiveMinutes();
