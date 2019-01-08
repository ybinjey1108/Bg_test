<?php

namespace App\Console\Commands\Bg;

use Illuminate\Console\Command;
use anlutro\cURL\Laravel\cURL;
use Illuminate\Foundation\Inspiring;

class TransferRecord extends Command
{
    /**
     * The name and signature of the console command.
     * 帶入的值與signature必須空一格
     * @var string
     */
    protected $signature = 'bg:transferrecord {loginId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $currency = 'MYR'; //幣別
        $secretKey =config('bg.' . $currency . '.secretKey'); 
        $random = config('bg.' . $currency . '.random'); //UUID
        $sn = config('bg.' . $currency . '.sn');  //歷代碼
        $loginId = $this->argument('loginId'); 
        $sign = md5($random . $sn .  $secretKey);  //加密
        $method = "open.balance.transfer.query"; //api前綴
        
        $url =config('bg.' . $currency . '.url'); //Domain
        $response = cURL::post($url.'?'.http_build_query([  //send request get response 
            'method'=> $method,
            'random'=> $random,
            'sign' => $sign,
            'sn' => $sn,
            'loginId' => $loginId, 
        ]));
        $result = $response->body;
        $this->info($result);
    }
}
