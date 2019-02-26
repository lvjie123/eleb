<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Shop_categorie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $shops = Shop::paginate(3);
        return view('shop.index',['shops' => $shops]);
    }

    public function examine(Request $request,Shop $shop)
    {
        if($shop->status==0){
            $shop->status = 1;
            $request->session()->flash('success','审核成功');
        }else{
            $shop->status = 0;
            $request->session()->flash('success','禁用成功');
        }
        $shop->save();

        return redirect()->route('shop.index');
    }

    public function destroy(Shop $shop,User $user)
    {
        $shop_id = $shop->id;
        $shop->delete();
        DB::delete("delete from users where shop_id='$shop_id'");
        session()->flash('success','店铺删除成功');
        return redirect()->route('shop.index');
    }

    public function show(Shop $shop){
        $shops = Shop::all();
        return view('shop.show',compact('shop','shops'));
    }

    public function edit(Shop $shop){
        $shop_categories = Shop_categorie::all();
        $shops = Shop::all();
        return view('shop.edit',compact('shop','shops','shop_categories'));
    }

    public function update(Shop $shop,Request $request){
//        dd(123);
        $this->validate($request,
            [
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

        $shop->update([
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
            ]);

        $request->session()->flash('success','店铺信息修改成功');
        return redirect()->route('shop.index');
    }
    public function upload(Request $request)
    {
        $img = $request->file('file');
        $path = Storage::url($img->store('public/shop'));
        return ['path'=>$path];
    }



}
