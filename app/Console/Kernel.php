<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //

    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('send:notifications')
            ->dailyAt('08:00')
            ->withoutOverlapping()
            ->evenInMaintenanceMode()
            ->runInBackground();

        $schedule->command('backup:run')
            ->withoutOverlapping()
            ->weekly()
            ->wednesdays()
            ->fridays()
            ->at('00:00')
            ->evenInMaintenanceMode()
            ->runInBackground();

        $schedule->command('activitylog:clean --days=7')
            ->daily()
            ->runInBackground()
            ->withoutOverlapping();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
