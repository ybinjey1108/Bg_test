<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
//use GuzzleHttp\Psr7\Request;
use anlutro\cURL\Laravel\cURL;
use Illuminate\Support\Facades\Hash;
use Artisan;
class BGController extends Controller
{
    public function CreateUser(Request $request) //創建帳號 
    {
         \Artisan::call('bg:createuser',[
             'loginId'=>$request->loginId,
             'nickname'=>$request->nickname,    
         ]);
        $result = trim(Artisan::output());
        return $result;
    }

    public function UserGet(Request $request){ //查詢會員資料
        \Artisan::call('bg:userget',['loginId' => $request->loginId]);
        $result = trim(Artisan::output());
        return $result;
    }

    public function GetBalance(Request $request){ //查詢餘額
        \Artisan::call('bg:getbalance',['loginId' => $request->loginId]);
        $result = trim(Artisan::output());
        return $result;
    }
    public function Credit(Request $request){ //轉入款項
        \Artisan::call('bg:credit',['loginId'=> $request->loginId, 'amount'=>$request->amount]);
        $result = trim(Artisan::output());
        return $result;
    }
    public function Debit(Request $request){ //轉出款項
        \Artisan::call('bg:debit',['loginId'=> $request->loginId, 'amount'=>$request->amount]);
        $result = trim(Artisan::output());
        return $result;
    }
    public function TransferRecord(Request $request){ //轉帳紀錄
        \Artisan::call('bg:transferrecord',['loginId'=> $request->loginId]);
        $result = trim(Artisan::output());
        return $result;
    }
}
