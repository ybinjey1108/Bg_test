<?php

namespace App\Console\Commands\Bg;

use Illuminate\Console\Command;
use anlutro\cURL\Laravel\cURL;
use Illuminate\Foundation\Inspiring;

class GetBalance extends Command
{
    /**
     * The name and signature of the console command.
     * 帶入的值與signature必須空一格
     * @var string
     */
    protected $signature = 'bg:getbalance {loginId}';

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
        $secretCode = base64_encode(sha1(config('bg.'.$currency.'.secretCode'),true)); //secretCode=base64(sha1(password)) 
        $random = config('bg.' . $currency . '.random'); //UUID
        $sn = config('bg.'.$currency.'.sn');  //歷代碼
        $loginId = $this->argument('loginId');
        $digest = md5($random . $sn . $loginId . $secretCode); //digest加密
        $method = "open.balance.get"; //api前綴
        
        $url = config('bg.' .$currency. '.sn'); //Domain
        $response = cURL::post($url.'?'.http_build_query([ //sent request get response
            'method'=> $method,
            'random'=> $random,
            'digest' => $digest,
            'sn' => $sn,
            'loginId' => $loginId, 
        ])); 
        $result = $response->body;
        $this->info($result);
    }
}
