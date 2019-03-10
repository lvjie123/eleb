<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Event_member;
use App\Models\Event_prize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $events = Event::paginate(3);
        return view('event.index',['events'=>$events]);
    }

    public function baoming($id)
    {
        $time = Date("Y-m-d");
        $events_id = $id;
        $time2 = date('Y-m-d',Event::find($events_id)->signup_end);
        $s = Event::find($events_id)->is_prize;
        $ss = Event_prize::where('events_id','=',$events_id)->count();
        $aa = Event::find($events_id)->signup_num;
        $cc = Event_member::where('events_id','=',$events_id)->count();
        if( $aa<=$cc ){
            return redirect()->route('event.index')->with('danger','报名失败，报名人数已满');
        }
        if($ss==0){
            return redirect()->route('event.index')->with('danger','报名失败，活动还未设置奖品');
        }
        if($s!=0){
            return redirect()->route('event.index')->with('danger','报名失败，已经开奖了');
        }
        if($time2<$time){
            return redirect()->route('event.index')->with('danger','报名失败，报名已经截止');
        }
        $member_id = \auth()->user()->id;
        $a = Event_member::where('events_id','=',$events_id)->where('member_id','=',$member_id)->count();
        if($a==0){
            Event_member::create([
                'events_id'=>$events_id,
                'member_id'=>$member_id
            ]);
            return redirect()->route('event.index')->with('success','报名成功');
        }else{
            return redirect()->route('event.index')->with('danger','报名失败，你已经报过名了');
        }
    }

    public function show(Event $event)
    {
        $a = Event::find($event->id)->is_prize;
        if($a==0){
            return redirect()->route('event.index')->with('danger','还没开奖，请耐心等待');
        }else{
            $rows = Event_prize::where('events_id','=',$event->id)->get();
            return view('event.show',compact('event','rows'));
        }
    }
}
