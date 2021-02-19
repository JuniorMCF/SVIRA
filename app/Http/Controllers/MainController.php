<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('doctor');
        $this->middleware('auth');
        
    }


    public function index(){

        return view('doctor.main');
    }

   
}
