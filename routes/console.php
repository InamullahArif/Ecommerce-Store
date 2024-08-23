<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


// Artisan::command('schedule:run', function (Schedule $schedule) {
//     // Schedule the discount email command to run daily at 5:20 PM
//     // $schedule->command('email:send-discount')->dailyAt('15:10');
//     $schedule->command('email:send-discount')->everyMinute();
// });

// Schedule::call('email:send-discount')->everyMinute();
Schedule::command('email:send-discount')->everyMinute();