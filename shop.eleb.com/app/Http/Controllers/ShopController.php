<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Shop_categorie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    //
    public function index()
    {
        return view('shop.index');
    }

    public function create()
    {
        $shop_categories = Shop_categorie::all();
        return view('shop.add',compact('shop_categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'email' => 'required|E-Mail',
                'password' => 'required',
                'shop_category_id' => 'required',
                'shop_name' => 'required',
                'brand' => 'required',
                'on_time' => 'required',
                'fengniao' => 'required',
                'bao' => 'required',
                'piao' => 'required',
                'zhun' => 'required',
                'start_send' => 'required|integer',
                'send_cost' => 'required|integer',
                'notice' => 'required',
                'discount' => 'required',
                'img'=>'required'
            ],
            [
                'name.required' => '商家名称不能为空',
                'email.required' => 'email不能为空',
                'email.E-Mail' => 'email格式不正确',
                'password.required' => '密码不能为空',
                'shop_category_id.required' => '分类不能为空',
                'shop_name.required' => '店铺名不能为空',
                'brand.required' => '品牌不能为空',
                'on_time.required' => '是否准时不能为空',
                'fengniao.required' => '是否蜂鸟配送不能为空',
                'bao.required' => '是否保标记不能为空',
                'piao.required' => '是否票标记不能为空',
                'zhun.required' => '是否准标记不能为空',
                'start_send.required' => '起送金额不能为空',
                'start_send.integer' => '起送金额必须是整数',
                'send_cost.required' => '配送费不能为空',
                'send_cost.integer' => '配送费必须是整数',
                'notice.required' => '店公告不能为空',
                'discount.required' => '优惠信息不能为空',
                'img.required'=>'请上传店铺图片',
            ]
        );

//        $shop_img = $request->file('shop_img');
//        $path = url(Storage::url($shop_img->store('public/shop')));

        $haha = Shop::create([
            'shop_category_id' => $request->shop_category_id,
            'shop_name' => $request->shop_name,
            'brand' => $request->brand,
            'on_time' => $request->on_time,
            'fengniao' => $request->fengniao,
            'bao' => $request->bao,
            'piao' => $request->piao,
            'zhun' => $request->zhun,
            'start_send' => $request->start_send,
            'send_cost' => $request->send_cost,
            'notice' => $request->notice,
            'discount' => $request->discount,
            'shop_img'=>$request->img,
            'shop_rating'=>rand(60,80),
            'status'=>0,
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'remember_token' => uniqid(),
            'shop_id' => $haha->id,
            'status' => 1,
        ]);


        $request->session()->flash('success', '商铺注册成功成功，等待审核');
        return redirect()->route('login');
    }

    public function edits()
    {
        return view('shop.edit');
    }

    public function changePassword(Request $request)
    {
        //表单三个字段 old_password new_password new_password_confirmation
        //验证
        $this->validate($request,[
            'old_password'=>'required',
            'new_password'=>'required|confirmed',//confirmed 要求new_password字段值和new_password_confirmation一致
            'new_password_confirmation'=>'required',
        ]);
        $admin = Auth::user();
        if(!Hash::check($request->old_password,$admin->password)){
            return back()->with('danger','旧密码不正确');
        }
        $admin->update(['password'=>Hash::make($request->new_password)]);
        Auth::logout();
        return redirect()->route('login')->with('danger','密码已修改，请重新登录');

    }
    public function upload(Request $request)
    {
        $img = $request->file('file');
        $path = Storage::url($img->store('public/shop'));
        return ['path'=>$path];
    }
}
