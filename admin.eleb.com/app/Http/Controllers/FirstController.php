<?php

namespace App\Http\Controllers;

use App\Models\Nav;
use Illuminate\Http\Request;

class FirstController extends Controller
{
    //
    public function index()
    {
        return view('first.index');
    }
}
