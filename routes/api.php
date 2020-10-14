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
Route::post('login', 'api\ApiController@login');
Route::post('/register', 'api\ApiController@register');
Route::post('/quoteSubmit', 'api\QuoteController@store');
Route::get('/featuredServices', 'api\ServiceController@index');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth.jwt'], function () {

    Route::resource('quote', 'api\QuoteController');
    Route::get('logout', 'api\ApiController@logout');
    Route::post('/update', 'api\ApiController@update');
    Route::resource('service', 'api\ServiceController');
    Route::get('user', 'api\ApiController@getAuthUser');
    Route::get('pdf', 'api\QuoteController@responseSend');
    Route::get('client', 'api\CustomerController@getAllClients');
    Route::post('readQuote/{id}', 'api\QuoteController@readQuote');
    Route::post('response/{id}', 'api\QuoteController@responseSend');
    Route::post('approveQuote/{id}', 'api\QuoteController@approving');
    Route::get('approveQuote/', 'api\QuoteController@approvedQuotes');
    Route::get('/getQuoteResponse/{id}', 'api\ResponseController@show');
    Route::get('customerQuote/{id}', 'api\QuoteController@customerQuotes');

});
Route::resource('customer', 'api\CustomerController');
