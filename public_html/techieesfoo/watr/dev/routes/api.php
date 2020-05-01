<?php

use Illuminate\Http\Request;

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


Route::group([ 'prefix' => 'auth'], function (){ 
    Route::group(['middleware' => ['guest:api']], function () {
        Route::post('login', 'API\AuthController@login');
        Route::post('signup', 'API\AuthController@signup');
        Route::get('getalluser', 'API\AuthController@getAllUser');
        Route::get('/send-otp/{email}', 'API\EmailController@sendOtp');
        Route::get('test-centers/{state}', 'API\AuthController@gettestcenters');        

    });
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'API\AuthController@logout');
        Route::get('getuser', 'API\AuthController@getUser');
        Route::get('getalltests', 'API\TestController@getAllTests');
		Route::post('/addtocart','API\CartController@addtocart');
		Route::get('/cartitems','API\CartController@cartItems');
		Route::post('/addpartner','API\PartnerController@addPartner');
		Route::get('/allparameters','API\PartnerController@allParameters');
        Route::post('/contact', 'API\EmailController@contact');
        Route::post('/placeorder', 'API\OrderController@placeOrder');
        Route::post('/testfile', 'API\PartnerController@testfile');
        Route::post('/partner-assistance', 'API\PartnerController@assistance');

    });
}); 

