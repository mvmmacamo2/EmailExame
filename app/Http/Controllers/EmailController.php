<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Message;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meuemail =Auth()->user()->email;
        $emails2 = DB::table('messages')->where('to', $meuemail)->orderBy('id', 'desc')->get();

        return response()->json(["emails2"=>$emails2]);
    }


    public function totalinbox()
    {
        $meuemail =Auth()->user()->email;
        $numeroemailenviado = DB::table('messages')->where('to', $meuemail)->count();
        return response()->json(["nrtotal"=>$numeroemailenviado]);
    }

    public function getUsers()
    {
        $users = User::all();
        $users =User::orderBy('id', 'desc')->get();

        return response()->json(["users"=>$users]);
    }


    public function EmailsEnvados()
    {
       $meuemail =Auth()->user()->email;


       $emails = DB::table('messages')->where('from', $meuemail)->orderBy('id', 'desc')->get();

       // $numeroemailenviado = DB::table('messages')->where('from', $meuemail)->count();
       return response()->json(["sentemails"=>$emails]);
   }







   public function NrEmailsEnvados()


   {
       $meuemail =Auth()->user()->email;


     // $emails = DB::table('messages')->where('from', $meuemail)->orderBy('id', 'desc')->get();

       $numeroemailenviado = DB::table('messages')->where('from', $meuemail)->count();
       return response()->json(["nrsentemails"=>$numeroemailenviado]);
   }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $salvar = Message::create($request->all());
       return response()->json(['email'=>$salvar, 'message'=>'email enviado com Sucesso']);
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
        //
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
        //
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


    public function Enviar(Request $request){
        $salvar = Message::create($request->all());
        return response()->json(['email'=>$salvar, 'message'=>'email enviado com Sucesso']);
    }

    public function userlogado(){
        $useremail =Auth()->user()->email;

        return response()->json(['emaildouser'=>$useremail]);
    }

    public function iduserlogado(){
        $useremail =Auth()->user()->id;

        return response()->json(['iduser'=>$useremail]);
    }
}
