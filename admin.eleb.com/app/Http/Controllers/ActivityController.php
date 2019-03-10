<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Nav;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:ccc']);
    }
    public function index(Request $request)
    {
        $activitys = Activity::paginate(3);
        $time = date("Y-m-d H:i:s");
        if($request->keyword==1){
            $activitys = Activity::where('start_time','>',$time)->paginate(3);
        }elseif($request->keyword==2){
            $activitys = Activity::where('start_time','<',$time)->where('end_time','>',$time)->paginate(3);
        }elseif($request->keyword==3){
            $activitys = Activity::where('end_time','<',$time)->paginate(3);
        }
        return view('activity.index',['activitys' => $activitys,'keyword'=>$request->keyword]);
    }

    public function create()
    {
        return view('activity.add');
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'title' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'content' => 'required',

            ],
            [
                'title.required' => '活动名称不能为空',
                'start_time.required' => '开始时间不能为空',
                'end_time.required' => '结束时间不能为空',
                'content.required' => '活动详情不能为空',

            ]
        );

        Activity::create([
            'title' => $request->title,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'content' => $request->content,

        ]);

        $request->session()->flash('success', '活动添加成功');
        return redirect()->route('activity.index');
    }

    public function show(Activity $activity)
    {
        return view('activity.show',compact('activity'));
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();
        session()->flash('success','活动删除成功');
        return redirect()->route('activity.index');
    }

    public function edit(Activity $activity){
        return view('activity.edit',compact('activity'));
    }

    public function update(Activity $activity,Request $request){
        $this->validate($request,
            [//验证规则
                'title' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'content' => 'required',
            ],
            [//错误提示信息
                'title.required' => '活动名称不能为空',
                'start_time.required' => '开始时间不能为空',
                'end_time.required' => '结束时间不能为空',
                'content.required' => '活动详情不能为空',
            ]
        );

        $activity->update([
            'title' => $request->title,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'content' => $request->content,
        ]);
        $request->session()->flash('success','活动修改成功');
        return redirect()->route('activity.index');
    }

}
