<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $time = date("Y-m-d H:i:s");
        $activitys = Activity::where('start_time','<',$time)->where('end_time','>',$time)->paginate(3);
        return view('activity.index',['activitys' => $activitys,'keyword'=>$request->keyword]);
    }



    public function show(Activity $activity)
    {
        return view('activity.show',compact('activity'));
    }

}
