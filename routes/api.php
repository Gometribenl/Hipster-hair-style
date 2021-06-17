<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:sanctum')->get('/user1', function (Request $request) {
    return $request->user();
});

//database routes
Route::resource('/products', 'ProductsController');
Route::resource('/tax', 'TaxController')->only(['index','store']);
Route::resource('/user', 'UserController');
Route::post('/user/login', 'UserController@login');
