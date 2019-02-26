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

