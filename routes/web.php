<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('createuser','BGController@CreateUser'); //創建會員
Route::get('userget','BGController@UserGet'); //查詢會員資料
Route::get('getbalance','BGController@GetBalance'); //查詢餘額
Route::get('credit','BGController@Credit'); //轉入
Route::get('debit','BGController@Debit'); //轉出
Route::get('transferrecord','BGController@TransferRecord'); //轉賬記錄
