<?php

namespace App\Http\Controllers;

use App\Models\Shop_categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Shop_categorieController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $shop_categories = Shop_categorie::paginate(3);
        return view('shop_categorie.index',['shop_categories'=>$shop_categories]);
    }

    public function create(){
        return view('shop_categorie.add');
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'status' => 'required',
                'img'=>'required|image|max:2048'
            ],
            [
                'name.required' => '分类名称不能为空',
                'status.required' => '状态不能为空',
                'img.required'=>'请上传分类图片',
                'img.image'=>'图片格式不正确',
                'img.max'=>'图片大小不能超过2M',
            ]
        );

        $img = $request->file('img');
        $path = $img->store('public/shop_categorie');

        Shop_categorie::create([
            'name' => $request->name,
            'status' => $request->status,
            'img'=>$path,
        ]);

        $request->session()->flash('success', '商品添加成功');
        return redirect()->route('shop_categorie.index');
    }

    public function destroy(Shop_categorie $Shop_categorie)
    {
        $Shop_categorie->delete();
        session()->flash('success','商品删除成功');
        return redirect()->route('shop_categorie.index');
    }

    public function edit(Shop_categorie $shop_categorie){
        return view('shop_categorie.edit',compact('shop_categorie'));
    }

    public function update(Shop_categorie $Shop_categorie,Request $request){
        $this->validate($request,
            [
                'name' => 'required',
                'status' => 'required',
                'img'=>'required|image|max:2048'
            ],
            [
                'name.required' => '分类名称不能为空',
                'status.required' => '状态不能为空',
                'img.required'=>'请上传分类图片',
                'img.image'=>'图片格式不正确',
                'img.max'=>'图片大小不能超过2M',
            ]
        );

        $img = $request->file('img');
        $path = $img->store('public/shop_categorie');

        $Shop_categorie->update([
            'name' => $request->name,
            'status' => $request->status,
            'img'=>$path,
        ]);
        $request->session()->flash('success','商品修改成功');
        return redirect()->route('shop_categorie.index');
    }

    public function upload(Request $request)
    {
        $img = $request->file('img');
        $path = Storage::url($img->store('public/shop_categorie'));
        return $path;
    }

}
