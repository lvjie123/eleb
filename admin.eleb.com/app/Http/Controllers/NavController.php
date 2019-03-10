<?php

namespace App\Http\Controllers;

use App\Models\Nav;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class NavController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $navs = Nav::orderBy('pid')->paginate(3);
        $ns = Nav::where('pid','=','0')->get();
        return view('nav.index',compact('navs','ns'));
    }

    public function create()
    {
        $navs = Nav::where('pid','0')->get();
        return view('nav.add',['navs'=>$navs]);
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'pid' => 'required',
                'url' => 'required',
            ],
            [
                'name.required' => '菜单名不能为空',
                'pid.required' => '上级菜单不能为空',
                'url.required' => '地址路由不能为空',
            ]
        );
        Nav::create([
            'name'=>$request->name,
            'pid'=>$request->pid,
            'url'=>$request->url,
            'permission_id'=>0
        ]);
        $request->session()->flash('success', '菜单添加成功');
        return redirect()->route('nav.index');
    }

    public function edit(Nav $nav)
    {
        $navs = Nav::where('pid','0')->get();
        return view('nav.edit',compact('nav','navs'));
    }

    public function update(Request $request,Nav $nav)
    {
        $this->validate($request,
            [
                'name' => 'required',

                'url' => 'required',
            ],
            [
                'name.required' => '菜单名不能为空',

                'url.required' => '地址路由不能为空',
            ]
        );
        if($request->pid!=null){
            $nav->update([
                'name'=>$request->name,
                'pid'=>$request->pid,
                'url'=>$request->url,
            ]);
        }else{
            $nav->update([
                'name'=>$request->name,
                'pid'=>0,
                'url'=>$request->url,
            ]);
        }


        $request->session()->flash('success', '菜单修改成功');
        return redirect()->route('nav.index');
    }

    public function destroy(Request $request,Nav $nav)
    {
        if($nav->pid==0){
            $a = Nav::where('pid','=',$nav->id)->count();
            if($a<=0){
                $nav->delete();
                $request->session()->flash('success', '菜单删除成功');
                return redirect()->route('nav.index');
            }else{
                $request->session()->flash('danger', '有子菜单，不能删除');
                return redirect()->route('nav.index');
            }
        }else{
            $nav->delete();
            $request->session()->flash('success', '菜单删除成功');
            return redirect()->route('nav.index');
        }
    }

    public function editt($id)
    {
        $nav = Nav::find($id);
        $permissions = Permission::all();
        return view('nav.editt',compact('nav','permissions'));
    }

    public function rupdate(Request $request,$id)
    {

        $nav = Nav::find($id);
        $nav->permission_id=$request->permission_id;
        $nav->save();
        $request->session()->flash('success', '权限修改成功');
        return redirect()->route('nav.index');
    }


}
