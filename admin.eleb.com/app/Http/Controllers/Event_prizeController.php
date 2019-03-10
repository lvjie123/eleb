<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Event_prize;
use Illuminate\Http\Request;

class Event_prizeController extends Controller
{
    //
    public function index()
    {
        $event_prizes = Event_prize::paginate(3);
        return view('event_prize.index',['event_prizes'=>$event_prizes]);
    }

    public function create()
    {
        $events = Event::all();
        return view('event_prize.add',['events'=>$events]);
    }

    public function store(Request $request){
        $this->validate($request,
            [
                'name' => 'required',
                'events_id' => 'required',
                'description' => 'required',
            ],
            [
                'name.required' => '奖品名称不能为空',
                'events_id.required' => '所属活动不能为空',
                'description.required' => '奖品详情不能为空',
            ]
        );
        Event_prize::create([
            'name' => $request->name,
            'events_id' => $request->events_id,
            'description' => $request->description,
            'member_id'=> 0
        ]);
        $request->session()->flash('success', '奖品添加成功');
        return redirect()->route('event_prize.index');
    }

    public function destroy(Event_prize $event_prize)
    {
        $event_prize->delete();
        session()->flash('success','奖品删除成功');
        return redirect()->route('event_prize.index');
    }

    public function edit(Event_prize $event_prize)
    {
        $events = Event::all();
        return view('event_prize.edit',compact('event_prize','events'));
    }

    public function update(Event_prize $event_prize,Request $request){
        $this->validate($request,
            [
                'name' => 'required',
                'events_id' => 'required',
                'description' => 'required',
            ],
            [
                'name.required' => '奖品名称不能为空',
                'events_id.required' => '所属活动不能为空',
                'description.required' => '奖品详情不能为空',
            ]
        );

        $event_prize->update([
            'name' => $request->name,
            'events_id' => $request->events_id,
            'description' => $request->description,
        ]);
        $request->session()->flash('success','奖品修改成功');
        return redirect()->route('event_prize.index');
    }
}
