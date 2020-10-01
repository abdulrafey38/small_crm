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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('pdf','api\QuoteController@responseSend');
Route::post('login', 'api\ApiController@login');
Route::resource('quote','api\QuoteController');
Route::resource('service', 'api\ServiceController');
Route::resource('customer', 'api\CustomerController');
Route::get('client', 'api\CustomerController@getAllClients');
Route::get('customerQuote/{id}', 'api\QuoteController@customerQuotes');
Route::post('response/{id}', 'api\QuoteController@responseSend');



Route::group(['middleware' => 'auth.jwt'], function () {

    Route::get('logout', 'api\ApiController@logout');
    Route::get('user', 'api\ApiController@getAuthUser');

});
