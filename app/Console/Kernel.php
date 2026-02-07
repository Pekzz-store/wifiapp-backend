<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Services\ConnectionMonitorService;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        /**
         * ===============================
         * EXISTING SCHEDULER (JANGAN DIHAPUS)
         * ===============================
         */
        $schedule->command('payments:generate')
            ->monthlyOn(1, '00:10');

        /**
         * ===============================
         * AUTO CEK KONEKSI MIKROTIK
         * ===============================
         */
        $schedule->call(function () {
            app(ConnectionMonitorService::class)->checkConnections();
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
