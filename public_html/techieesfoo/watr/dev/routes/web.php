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



// Route::get('/contact', function () {
//     return view('contact');
// });




// Route::get('/doctors-chamber', function () {
//     return view('doctorsChamber');
// });


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/send-otp/{email}', 'EmailController@sendOtp');

#Route::get('user/{id}', 'UserController@show');

Route::prefix('admin')->group(function() {

	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login','Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::get('/', 'AdminController@index')->name('admin');
    Route::resource('parameter', 'Admin\ParameterManagementController');
    Route::resource('test', 'Admin\TestManagementController');
    Route::get('parameter/delete/{id}', array('as' => 'admin.parameter.delete', 'uses' => 'Admin\ParameterManagementController@delete'));
    Route::get('test/delete/{id}', array('as' => 'admin.test.delete', 'uses' => 'Admin\TestManagementController@delete'));
    // Route::get('/user/{$id}', 'Admin\UserManagementController@show')->name('admin.user.show');
    Route::get('user/{id}', array('as' => 'admin.user.show', 'uses' => 'Admin\UserManagementController@show'));

    Route::get('/user', 'Admin\UserManagementController@index')->name('admin.user.index');

    Route::resource('contact', 'Admin\ContactController');

    Route::resource('partner', 'Admin\PartnerController');

    Route::resource('order', 'Admin\OrderController');


Route::get('partner/statuschange/{id}', array('as' => 'admin.partner.statuschange', 'uses' => 'Admin\PartnerController@statuschange'));

});