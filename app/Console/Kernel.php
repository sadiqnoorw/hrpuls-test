<?php

namespace App\Console;

use App\Console\Commands\ApplyFutureChanges;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    // Register the commands for the application
    protected $commands = [
        ApplyFutureChanges::class,
    ];

    // Define the schedule for the application
    protected function schedule(Schedule $schedule)
    {
        // Run the 'apply-future-changes' command daily at midnight
        $schedule->command('employee:apply-future-changes')->everyMinute();//everyMinute('00:00');
    }
}
