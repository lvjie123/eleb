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
//Route::get('logout','LoginController@destroy')->name('logout');
route::get('/Api/businessList','ApiController@businessList');
route::get('/Api/business','ApiController@business');
route::get('/Api/sms','ApiController@sms');
route::post('/Api/regist','ApiController@regist');
route::post('/Api/loginCheck','ApiController@loginCheck');
