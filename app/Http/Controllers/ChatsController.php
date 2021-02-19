<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('doctor');
    }


    public function index(){

        $chats = Chat::select('chats.id','chats.state','users.name')->join('users','users.id','=','chats.id_user')->where("state","pendiente")->get();

        return view('doctor.chats',compact('chats',$chats));
    }

    public function acceptChat(Request $request){

        //var_dump($request->id_chat);

        $chat = Chat::find($request->id_chat)->first();

        $chat->id_doctor = Auth::user()->id;

        $chat->state = "consulta";

        $chat->save();

        return redirect()->route('salachat',['id_user'=>$chat->id_user,'id_chat'=>$chat->id]);
    }

    public function createTeleconsulta(){

        
    }
}
