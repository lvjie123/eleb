<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Event_member;
use App\Models\Event_prize;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller
{
    //
    public function index()
    {
        $events = Event::paginate(3);
        return view('event.index',['events'=>$events]);
    }

    public function create()
    {
        return view('event.add');
    }

    public function store(Request $request){
        $this->validate($request,
            [
                'title' => 'required',
                'signup_start' => 'required',
                'signup_end' => 'required',
                'prize_date' => 'required',
                'signup_num' => 'required',
                'content' => 'required',

            ],
            [
                'title.required' => '活动名称不能为空',
                'signup_start.required' => '开始时间不能为空',
                'signup_end.required' => '结束时间不能为空',
                'prize_date.required' => '开奖时间不能为空',
                'signup_num.required' => '人数限制不能为空',
                'content.required' => '活动详情不能为空',
            ]
        );
        Event::create([
            'title' => $request->title,
            'signup_start' => strtotime($request->signup_start),
            'signup_end' => strtotime($request->signup_end),
            'prize_date' => $request->prize_date,
            'signup_num' => $request->signup_num,
            'content' => $request->content,
            'is_prize'=> 0

        ]);
        $request->session()->flash('success', '活动添加成功');
        return redirect()->route('event.index');
    }

    public function show(Event $event)
    {
        return view('event.show',compact('event'));
    }

    public function destroy(Event $event)
    {
        $event->delete();
        session()->flash('success','活动删除成功');
        return redirect()->route('event.index');
    }

    public function edit(Event $event){
        return view('event.edit',compact('event'));
    }

    public function update(Event $event,Request $request){
        $this->validate($request,
            [
                'title' => 'required',
                'signup_start' => 'required',
                'signup_end' => 'required',
                'prize_date' => 'required',
                'signup_num' => 'required',
                'content' => 'required',

            ],
            [
                'title.required' => '活动名称不能为空',
                'signup_start.required' => '开始时间不能为空',
                'signup_end.required' => '结束时间不能为空',
                'prize_date.required' => '开奖时间不能为空',
                'signup_num.required' => '人数限制不能为空',
                'content.required' => '活动详情不能为空',
            ]
        );

        $event->update([
            'title' => $request->title,
            'signup_start' => strtotime($request->signup_start),
            'signup_end' => strtotime($request->signup_end),
            'prize_date' => $request->prize_date,
            'signup_num' => $request->signup_num,
            'content' => $request->content,
            'is_prize'=> 0
        ]);
        $request->session()->flash('success','活动修改成功');
        return redirect()->route('event.index');
    }

    public function open(Event $event){
        $count =Event_prize::where('events_id','=',$event->id)->count();
        $mcount =Event_member::where('events_id','=',$event->id)->count();
        if($count!=0&&$mcount!=0){
            $allMember = Event_member::where('events_id','=',$event->id)->pluck('member_id')->toArray();
            shuffle($allMember);
            $prize = Event_prize::where('events_id','=',$event->id)->get();
            for($i=0;$i<$count;$i++){
                $prize[$i]->member_id = $allMember[$i];
                $prize[$i]->save();
                $title = '反馈已经发送';
                $goods = $prize[$i]->name;
                $user = User::where('id','=',$allMember[$i])->first();
                $content = '<p>
                    您参加的活动的反馈已经发送了
                </p>';
                try{
                    $flag =Mail::send('email.kj',compact('title','content','goods'),
                        function($message) use($user){
                            $to = $user->email;
                            $message->from(env('MAIL_USERNAME'))->to($to)->subject('饿了吧外卖平台');
                        });
                }catch (\Exception $e){
//                    var_dump($e);exit;
                    return '邮件发送失败';
                }
            }
            $event->is_prize = 1;
            $event->save();
            return redirect()->route('event.index')->with('success','开奖成功');
        }else{
            dd("爱你哟");
        }
    }

}
