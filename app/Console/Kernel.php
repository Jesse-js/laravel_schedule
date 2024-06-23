<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('app:test-command')->everyMinute();
        $schedule->command('app:my-test')->before(function () {
            Log::info("Before command in console.php");
        })->after(function () {
            Log::info("After command in console.php");
        })->daily()->timezone('America/Sao_Paulo')
            ->at('23:03')->name('my-test');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
