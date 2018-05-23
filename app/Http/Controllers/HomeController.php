<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['welcome']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentTime = Carbon::now();
        return view('home')->with('currentTime', $currentTime);
    }

    public function welcome()
    {
        $currentTime = Carbon::now();
        return view('welcome')->with('currentTime', $currentTime);
    }
}
