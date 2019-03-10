<?php

namespace App\Http\Controllers;

use App\Models\Event_member;
use Illuminate\Http\Request;

class Event_memberController extends Controller
{
    //
    public function index()
    {
        $event_members = Event_member::paginate(3);
        return view('event_member.index',['event_members'=>$event_members]);
    }
}
