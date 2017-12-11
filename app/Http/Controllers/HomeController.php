<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meuemail =Auth()->user()->email;


        $emails = DB::table('messages')->where('to', $meuemail)->get();
        $emails =Message::orderBy('id', 'desc')->get();

        return view('home', compact('emails'));



       // $emailsvue= Message::all();
        // return respose()->json(["emailvue"=> $emailsvue]);
    }
}
