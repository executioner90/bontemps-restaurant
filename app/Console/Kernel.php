<?php

namespace App\Console;

use App\Jobs\Meal\GenerateWeeklySpecials;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->job(new GenerateWeeklySpecials)
            ->weeklyOn(6, '00:00'); // Saturday at 00:00
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
