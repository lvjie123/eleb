<?php

namespace App\Http\Controllers;

use App\Models\Menu_categorie;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
//        $kk = Menu_categorie::all();
//        $keyword = $request->keyword;
//        $user = Auth::user();
////        dd($user);
//        if($keyword){
//            $menus = Menu::where('category_id','=',"$keyword")->where('shop_id','=',$user->shop_id)->paginate(3);
//        }else{
//            $menus =  Menu::where('shop_id','=',$user->shop_id)->paginate(3);
//        }
////        dd($menus);
//        return view('menus.index',compact('menus','kk','keyword'));


        $rows = Menu::where('shop_id','=',Auth::user()->shop_id);

        //分类
        if($request->keyword){
            $rows->where('category_id','=',$request->keyword);
        }

        //最小价格
        if($request->start){
            $rows->where('goods_price','>=',$request->start);
        }
        //最大价格
        if($request->end){
            $rows->where('goods_price','<=',$request->end);
        }
        $menus = $rows->paginate(3);
        //菜品分类列表
        $kk = Menu_categorie::all();
        return view('menus.index',['menus'=>$menus,'kk'=>$kk,'keyword'=>$request->keyword,'category_id'=>$request->category_id,'start'=>$request->start,'end'=>$request->end]);






    }

    public function create()
    {
        $kk = Menu_categorie::all();
        return view('menus.add',['kk'=>$kk]);
    }
    public function store(Request $request){
        $this->validate($request,[
            'goods_name'=>'required',
            'goods_price'=>'required',
            'description'=>'required',
            'tips'=>'required',
            'goods_img'=>'required|image',
            'category_id'=>'required',
        ],[
            'goods_name.required'=>'菜品名不能为空',
            'goods_price.required'=>'价格不能为空',
            'description.required'=>'描述不能为空',
            'tips.required'=>'提示不能为空',
            'category_id.required'=>'分类不能为空',
            'goods_img.required'=>'图片不能为空',
            'goods_img.image'=>'图片上传错误',
        ]);
        $user = auth()->user();
        $menu = new Menu();
        $img = $request->file('goods_img');
        $path=$img->store('public/menu');
        $menu->goods_name = $request->goods_name;
        $menu->goods_price = $request->goods_price;
        $menu->description = $request->description;
        $menu->tips = $request->tips;
        $menu->category_id = $request->category_id;
        $menu->goods_img = url(Storage::url($path));
        $menu->shop_id=$user->shop_id;
        $menu->month_sales=rand(0,500);
        $menu->rating_count=rand(1,5);
        $menu->satisfy_count=rand(1,5);
        $menu->satisfy_rate=rand(1,5);
        $menu->rating=rand(1,5);
        $menu->status=1;
        $menu->save();
        return redirect()->route('menus.index')->with('success','菜品添加成功');
    }

    public function destroy(Menu $menu){
        $menu->delete();
        return redirect()->route('menus.index')->with('success','菜品删除成功');
    }

    public function edit(Menu $menu)
    {
        $kk = Menu_categorie::all();
        return view('menus.edit',compact('menu','kk'));
    }

    public function update(Menu $menu,Request $request){

        $this->validate($request,[
            'goods_name'=>'required',
            'goods_price'=>'required',
            'description'=>'required',
            'tips'=>'required',
            'goods_img'=>'required|image',
            'category_id'=>'required',
        ],[
            'goods_name.required'=>'菜品名不能为空',
            'goods_price.required'=>'价格不能为空',
            'description.required'=>'描述不能为空',
            'tips.required'=>'提示不能为空',
            'category_id.required'=>'分类不能为空',
            'goods_img.required'=>'图片不能为空',
            'goods_img.image'=>'图片上传错误',
        ]);

        $img = $request->file('goods_img');
        $path=$img->store('public/menu');
        $aa = url(Storage::url($path));


        $menu->update([
            'goods_name' => $request->goods_name,
            'category_id' => $request->category_id,
            'goods_price' => $request->goods_price,
            'description'=>$request->description,
            'tips'=>$request->tips,
            'goods_img'=>$aa,
        ]);

        return redirect()->route('menus.index')->with("info","修改成功");
    }

}
