<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Member;
use App\Models\Nav;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //

    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $members = Member::paginate(3);
        if($keyword){
            $members = Member::where('username','like',"%$keyword%")->paginate(3);
        }
        return view('member.index',['members' => $members,'keyword'=>$request->keyword]);
    }

    public function show(Request $request)
    {
        $id = $request->member;
        $addresses = Address::where('user_id','=',$id)->paginate(3);
        return view('member.show',['addresses'=>$addresses]);
    }

    public function examine(Request $request)
    {
        $member = Member::find($request->id);
        $member->status = 0;
        $member->save();
        return redirect()->route('member.index')->with('success','禁用成功');

    }
    public function examine1(Request $request)
    {
        $member = Member::find($request->id);
        $member->status = 1;
        $member->save();
        return redirect()->route('member.index')->with('success','启用成功');

    }
}
