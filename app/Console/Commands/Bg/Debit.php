<?php

namespace App\Console\Commands\Bg;

use Illuminate\Console\Command;
use anlutro\cURL\Laravel\cURL;
use Illuminate\Foundation\Inspiring;

class Debit extends Command
{
    /**
     * The name and signature of the console command.
     * 帶入的值與signature必須空一格
     * @var string
     */
    protected $signature = 'bg:debit {loginId}{amount}';

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
        $secretCode = base64_encode(sha1(config('bg.' . $currency . '.secretCode'),true)); //secretCode=base64(sha1(password)) 
        $random = config('bg.' . $currency . '.random'); //UUID
        $sn = config('bg.' . $currency . '.sn');  //歷代碼
        $loginId = $this->argument('loginId'); 
        $amount = $this->argument('amount');
        $digest = md5($random . $sn . $loginId . $amount . $secretCode);  //加密
        $method = "open.balance.transfer"; //api前綴
        
        $url = config('bg.' . $currency . '.url'); //Domain
        $response = cURL::post($url.'?'.http_build_query([  //send request get response 
            'method'=> $method,
            'sn' => $sn,
            'loginId' => $loginId, 
            'amount'=> $amount,
            'random'=> $random,
            'digest' => $digest,
        ]));
        $result = json_decode($response->body); 
        $this->info((float)$result->result);
    }
}
