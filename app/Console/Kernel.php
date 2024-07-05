<?php

namespace App\Console;

use App\Console\Commands\RehashPasswords;
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
        RehashPasswords::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Schedule artisan commands here.
        // $schedule->command('password:rehash')->hourly();

        // Rehash passwords every 24 hours
        // $schedule->command('passport:install')->hourly();

        // Run artisan command to rehash passwords every 24 hours
        // $schedule->command('rehash-passwords')->hourly();
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
