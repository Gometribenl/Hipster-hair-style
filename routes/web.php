<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
//mollie routes
Route::get('/order/pay/{total}', 'OrderController@preparePayment');
Route::get('/order/success', 'OrderController@handleErrorOrSuccess');
Route::post('/order/webhooks', 'OrderController@handleErrorOrSuccess');

//vue routes
Route::get('/{any}', function(){
    return view('welcome');
})->where('any', '^((?!order).)*');



