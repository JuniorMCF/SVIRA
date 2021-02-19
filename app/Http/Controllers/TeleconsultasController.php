<?php

namespace App\Http\Controllers;

use App\Models\Teleconsulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeleconsultasController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('doctor');
        $this->middleware('auth');
    }


    public function index(){

        $teleconsultas = Teleconsulta::select('users.name as doctorname','users.dni as dni','teleconsultas.especialidad','teleconsultas.fecha_programada','teleconsultas.link_google','teleconsultas.estado')->join('users','users.id','=','teleconsultas.id_paciente')->where("teleconsultas.id_doctor","=",Auth::user()->id)->get();

        return view('doctor.teleconsultas',["teleconsultas"=>$teleconsultas]);
    }
}
