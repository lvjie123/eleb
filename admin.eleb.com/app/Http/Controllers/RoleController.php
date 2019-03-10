<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Nav;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $roles = Role::paginate(3);
        if($keyword){
            $roles = Role::where('name','like',"%$keyword%")->paginate(3);
        }
        return view('role.index',['roles' => $roles,'keyword'=>$request->keyword]);
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('role.add',['permissions'=>$permissions]);
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'permission' => 'required',
            ],
            [
                'name.required' => '角色名不能为空',
                'permission.required' => '权限不能为空',
            ]
        );

        $data = [
            'name' => $request->name,
        ];

        $role = Role::create($data);
        $role->syncPermissions($request->permission);

        $request->session()->flash('success', '角色添加成功');
        return redirect()->route('role.index');
    }

    public function destroy(Role $role)
    {
        $admin = Admin::all();
        foreach ($admin as $a){
            if($a->hasRole($role->name)){
                session()->flash('danger','有用户不能删除');
                return redirect()->route('role.index');
            }
        }
        $role->delete();
        session()->flash('success','角色删除成功');
        return redirect()->route('role.index');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('role.edit',['permissions'=>$permissions,'role'=>$role]);
    }

    public function update(Request $request,Role $role)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'permission' => 'required',
            ],
            [
                'name.required' => '角色名不能为空',
                'permission.required' => '权限不能为空',
            ]
        );
        $r = Role::find($role->id);
        $r->name = $request->name;
        $r->save();
        $r->syncPermissions($request->permission);
        session()->flash('success','修改角色成功');
        return redirect()->route('role.index');

    }
}
