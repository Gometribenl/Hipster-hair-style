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
Route::get('/order/payment/{value}', 'OrderController@preparePayment');
Route::get('/order/success', 'OrderController@handleErrorOrSuccess');
Route::get('/order/webhooks', 'OrderController@handleErrorOrSuccess');

//database routes


//vue routes
Route::get('/{any}', function(){
    return view('welcome');
})->where('any', '^((?!order).)*');



