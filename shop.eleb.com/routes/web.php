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

Route::get('/shop/edits','ShopController@edits')->name('shop.edits');
Route::post('/shop/changepassword', 'ShopController@changepassword')->name('shop.changepassword');
Route::resource('shop','ShopController');
Route::resource('first','FirstController');

Route::get('login','LoginController@create')->name('login');
Route::post('login','LoginController@store')->name('login');
Route::get('logout','LoginController@destroy')->name('logout');
Route::resource('menu','Menu_categorieController');
Route::resource('menus','MenuController');
Route::resource('activity','ActivityController');
Route::post('/upload','MenuController@upload')->name('upload');
Route::post('/upload2','ShopController@upload')->name('upload');
Route::post('/upload1','MenuController@upload')->name('upload');
//订单
Route::get('/order','OrderController@orderlist')->name('orderlist');
Route::get('/order/cancel/{user}','OrderController@cancel')->name('cancel');
Route::get('/order/cancel1/{user}','OrderController@cancel1')->name('cancel1');
Route::get('/order/show/{id}','OrderController@showorder')->name('showorder');
Route::get('tongji','TongjiController@index')->name('tongji');
Route::get('caipin','TongjiController@caipin')->name('caipin');
Route::get('caipin1','TongjiController@caipin1')->name('caipin1');
//活动
Route::resource('event','EventController');
Route::get('/event/baoming/{id}','EventController@baoming')->name('baoming');
