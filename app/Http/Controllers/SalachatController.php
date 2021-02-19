<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalachatController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('doctor');
        $this->middleware('auth');
    }

    public function index($id_chat,$id_user){

        

        return view('doctor.salachat',['id_chat'=>$id_chat,'id_user'=>$id_user]);
    }

}
