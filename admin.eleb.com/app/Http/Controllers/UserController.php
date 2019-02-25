<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $users = User::paginate(3);
        return view('user.index',['users' => $users]);
    }

    public function show(User $user)
    {
        return view('user.show',compact('user'));
    }

    public function examine(Request $request,User $user)
    {
        if($user->status==0){
            $user->status = 1;
            $request->session()->flash('success','审核成功');
        }else{
            $user->status = 0;
            $request->session()->flash('success','禁用成功');
        }
        $user->save();

        return redirect()->route('user.index');
    }

    public function edit(User $user)
    {
        return view('user.edit',compact('user'));
    }

    public function update(Request $request,User $user){
        $this->validate($request,[
            'password'=>'required',
        ],
         [
             'password.required' => '密码不能为空',
         ]
        );
        $user->update([
            'password'=>Hash::make($request->password),
        ]);
        $request->session()->flash('success','重置密码成功');
        return redirect()->route('user.index');
    }
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success','商品删除成功');
        return redirect()->route('user.index');
    }
}
