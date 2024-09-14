<?php

namespace App\Console;

use App\Http\Controllers\Controller;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \Illuminate\Console\KeyGenerateCommand::class,
        \Illuminate\Http\Request::class
        // \Illuminate\Auth\Console\MakeAuthCommand::class,
        // \Illuminate\Database\Console\Migrations\MigrateCommand::class,
        // \Illuminate\Database\Console\Migrations\ResetCommand::class,
        // \Illuminate\Database\Console\Migrations\RefreshCommand::class,

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
    }
}
