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


Route::resource('first','FirstController');
Route::resource('shop_categorie','Shop_categorieController');
Route::resource('shop','ShopController');
Route::get('/shop/examine/{shop}','ShopController@examine')->name('shops.examine');
/*Route::get('/users', 'UsersController@index')->name('users.index');//用户列表
Route::get('/users/{user}', 'UsersController@show')->name('users.show');//查看单个用户信息
Route::get('/users/create', 'UsersController@create')->name('users.create');//显示添加表单
Route::post('/users', 'UsersController@store')->name('users.store');//接收添加表单数据
Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');//修改用户表单
Route::patch('/users/{user}', 'UsersController@update')->name('users.update');//更新用户信息
Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');//删除用户信息*/


Route::get('/admins/edits','AdminController@edits')->name('admins.edits');
Route::post('/admins/changepassword', 'AdminController@changepassword')->name('admins.changepassword');//接收添加表单数据
Route::resource('admins','AdminController');
Route::get('/user/examine/{user}','UserController@examine')->name('user.examine');
Route::resource('user','UserController');
Route::resource('activity','ActivityController');

Route::post('/upload','Shop_categorieController@upload')->name('upload');
Route::post('/upload1','ShopController@upload')->name('upload');

//登录和注销
Route::get('login','LoginController@create')->name('login');
Route::post('login','LoginController@store')->name('login');
Route::get('logout','LoginController@destroy')->name('logout');

Route::resource('member','MemberController');
Route::get('/member/examine/{id}','MemberController@examine')->name('member.examine');
Route::get('/member/examine1/{id}','MemberController@examine1')->name('member.examine1');
//权限
Route::resource('permission','PermissionController');
Route::resource('role','RoleController');
//导航菜单管理
Route::resource('nav','NavController');
Route::get('/nav/editt/{id}','NavController@editt')->name('nav.editt');
Route::post('/nav/rupdate/{id}','NavController@rupdate')->name('nav.rupdate');
//活动
Route::resource('event','EventController');
Route::resource('event_prize','Event_prizeController');
Route::resource('event_member','Event_memberController');
Route::get('/event/opeb/{event}','EventController@open')->name('event.open');



Route::get('/', function () {
    return view('welcome');
});