<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Nav;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth',[
            'only'=>['index'],
        ]);
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.create',['roles'=>$roles]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'password'=>'required',
            'email'=>'required',
            'role' => 'required',
        ]);

        //保存用户
        $data = Admin::create([
            'name'=>$request->name,
            'password'=>Hash::make($request->password),
            'email'=>$request->email,
//                Hash::make($request->password),//密码加密
            // 123456 admin   jdh345#$%gfada324  加盐加密
            //设置remember_token的值
            'remember_token' => uniqid(),
        ]);
        $data->syncRoles($request->role);
        return redirect()->route('admins.index')->with('success','管理员添加成功');
    }

    //管理员列表
    public function index()
    {
        $admins = Admin::all();
        return view('admin.index',compact('admins'));
    }

    public function edits()
    {
        return view('admin.edit');
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

    public function edit(Admin $admin)
    {
        $roles = Role::all();
        return view('admin.editt',['admin'=>$admin,'roles'=>$roles]);
    }

    public function update(Request $request,Admin $admin)
    {
        $this->validate($request,
            [
                'role' => 'required',
            ],
            [
                'role.required' => '角色不能为空',
            ]
        );
        $a = Admin::find($admin->id);
        $a->syncRoles($request->role);
        session()->flash('success','修改角色成功');
        return redirect()->route('admins.index');
    }

}
