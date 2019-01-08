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
        Commands\Bg\UserGet::class,  //查詢會員資料 
        Commands\Bg\CreateUser::class, //創建會員
        Commands\Bg\GetBalance::class, //查詢餘額
        Commands\Bg\Credit::class, //轉入
        Commands\Bg\Debit::class, //轉出
        Commands\Bg\TransferRecord::class, //轉帳紀錄
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commmands.php');
        //$this->load(__DIR__.'/Commands');
        //require base_path('routes/console.php');
        
    }
}
