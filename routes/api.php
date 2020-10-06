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

Route::post('/register', 'api\ApiController@register');
Route::post('login', 'api\ApiController@login');
Route::get('/featuredServices', 'api\ServiceController@index');
Route::post('/quoteSubmit', 'api\QuoteController@store');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth.jwt'], function () {

    Route::post('/update', 'api\ApiController@update');

    Route::get('logout', 'api\ApiController@logout');
    Route::get('user', 'api\ApiController@getAuthUser');
    Route::resource('service', 'api\ServiceController');

    Route::get('pdf', 'api\QuoteController@responseSend');

    Route::resource('quote', 'api\QuoteController');
    Route::resource('customer', 'api\CustomerController');

    Route::get('client', 'api\CustomerController@getAllClients');
    Route::get('customerQuote/{id}', 'api\QuoteController@customerQuotes');
    Route::post('response/{id}', 'api\QuoteController@responseSend');
    Route::post('readQuote/{id}', 'api\QuoteController@readQuote');
    Route::post('approveQuote/{id}', 'api\QuoteController@approving');

});
