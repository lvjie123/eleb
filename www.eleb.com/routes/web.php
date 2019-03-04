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
// 获得商家列表接口
route::get('/Api/businessList','ApiController@businessList');
// 获得指定商家接口
route::get('/Api/business','ApiController@business');
// 获取短信验证码接口
route::get('/Api/sms','ApiController@sms');
// 注册接口
route::post('/Api/regist','ApiController@regist');
// 登录验证接口
route::post('/Api/loginCheck','ApiController@loginCheck');
// 地址列表接口
route::get('/Api/addressList','ApiController@addressList');
// 保存新增地址接口
route::post('/Api/addAddress','ApiController@addAddress');
// 指定地址接口
route::get('/Api/address','ApiController@address');
// 保存修改地址接口
route::post('/Api/editAddress','ApiController@editAddress');
// 保存购物车接口
route::post('/Api/addCart','ApiController@addCart');
// 获取购物车数据接口
route::get('/Api/cart','ApiController@cart');
// 添加订单接口
route::post('/Api/addorder','ApiController@addorder');
// 获得指定订单接口
route::get('/Api/order','ApiController@order');
// 获得订单列表接口
route::get('/Api/orderList','ApiController@orderList');
// 修改密码接口
route::post('/Api/changePassword','ApiController@changePassword');
// 忘记密码接口
route::post('/Api/forgetPassword','ApiController@forgetPassword');

