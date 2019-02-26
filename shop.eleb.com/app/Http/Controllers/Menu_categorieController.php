<?php

namespace App\Http\Controllers;

use App\Models\Menu_categorie;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Menu_categorieController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $user = Auth::user();
//        dd($user);
        if($keyword){
            $menus = Menu_categorie::where('shop_id','=',$user->shop_id)->where('name','like',"%$keyword%")->paginate(3);
        }else{
            $menus =  Menu_categorie::where('shop_id','=',$user->shop_id)->paginate(3);
        }
        return view('menu.index',compact('menus','keyword'));
    }

    public function create()
    {
        return view('menu.add');
    }

    public function store(Request $request){
        //97 122
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required'
        ],[
            'name.required'=>'分类名不能为空',
            'description.required'=>'分类介绍不能为空',
        ]);
        if($request->is_selected==1){
            DB::update('update menu_categories set is_selected = 0 ');
        }
        $shop = auth()->user();
        $id = $shop->shop_id;
        $list = range('a','z')[rand(0,25)];
        $shop = new  Shop();
        $shop = $shop->find($id);
        $menuCategories = new Menu_categorie();
        $menuCategories->name = $request->name;
        $menuCategories->description = $request->description;
        $menuCategories->is_selected = $request->is_selected;
        $menuCategories->shop_id = $shop->id;
        $menuCategories->type_accumulation =$list;
        $menuCategories->save();
        return redirect()->route('menu.index')->with("success","添加成功");
    }

    public function destroy(Menu_categorie $menu){
        $id = $menu->id;
        $result = DB::select("select * from menus where category_id = $id");
        if ($result){
            return redirect()->route('menu.index')->with('danger','不是空菜品分类，不能删除');
        }
        $menu->delete();
        return redirect()->route('menu.index')->with('success','分类删除成功');
    }

    public function edit(Menu_categorie $menu)
    {
        return view('menu.edit',compact('menu'));
    }

    public function update(Menu_categorie $menu,Request $request){

        $this->validate($request,[
            'name'=>'required',
            'description'=>'required'
        ],[
            'name.required'=>'分类名不能为空',
            'description.required'=>'分类介绍不能为空',
        ]);

        if($request->is_selected==1){
            DB::update('update menu_categories set is_selected = 0 ');
        }
        $menu->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_selected'=>$request->is_selected,
        ]);

        return redirect()->route('menu.index')->with("info","修改成功");
    }

}
