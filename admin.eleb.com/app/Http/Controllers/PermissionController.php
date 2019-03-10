<?php

namespace App\Http\Controllers;

use App\Models\Nav;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $permissions = Permission::paginate(3);
        if($keyword){
            $permissions = Permission::where('name','like',"%$keyword%")->paginate(3);
        }
        return view('permission.index',['permissions' => $permissions,'keyword'=>$request->keyword]);
    }
    
    public function create()
    {
        return view('permission.add');
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
            ],
            [
                'name.required' => '权限名不能为空',
            ]
        );

        Permission::create([
            'name' => $request->name,
        ]);

        $request->session()->flash('success', '权限添加成功');
        return redirect()->route('permission.index');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        session()->flash('success','权限删除成功');
        return redirect()->route('permission.index');
    }

}
