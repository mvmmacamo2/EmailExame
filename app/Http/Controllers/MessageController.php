<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use DB;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = DB::table('users')
        // ->orderBy('name', 'desc')
        // ->get();


        $meuemail =Auth()->user()->email;

        $emails = DB::table('messages')->where('to', $meuemail)->orderBy('id', 'desc')->get();
        $numeroemail = DB::table('messages')->where('to', $meuemail)->count();
        return view('message.index', compact('emails'))->with('nremail', $numeroemail);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('message.create');
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $m= Message::create($request->all());
        // return response()->json(['email'=>$m, 'message'=>'cliente Adicionado com sucesso']);

        return redirect('email');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $email= Message::find($id);
        return view('message.edit', compact('email'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $email =Message::find($id);

        $email->update($request->all());

        return redirect('email');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function emailenviado(){
       $meuemail =Auth()->user()->email;


       $emails = DB::table('messages')->where('from', $meuemail)->orderBy('id', 'desc')->get();

       $numeroemailenviado = DB::table('messages')->where('from', $meuemail)->count();

       return view('message.emailenviado', compact('emails'))->with('nremail', $numeroemailenviado);
   }
}
