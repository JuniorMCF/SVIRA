<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Profile;
use App\Models\Vacineprofile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FichasviraController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){



        $profile = Profile::where('user_id',Auth::user()->id)->first();

        $vaccineprofile = Vacineprofile::where('id_user','=',Auth::user()->id)->get();

        $citas = Cita::where('id_paciente','=',Auth::user()->id)->get();

        return view('pdf',['profile'=>$profile,'vaccineprofile'=>$vaccineprofile,'sviravaccine'=>$citas]);
    }


    public function imprimir(){

        $profile = Profile::where('user_id',Auth::user()->id)->first();
        $vaccineprofile =VacineProfile::select('vacineprofiles.id','vacineprofiles.nombre_paciente','vaccines.name as vacuna','vaccines.tipo as tipo_inmun','vacineprofiles.dosis','vaccines.dosis as dosis_totales','vacineprofiles.hospital','vacineprofiles.fec_inmun')->join('vaccines','vaccines.id','=','vacineprofiles.id_vaccine')->where('vacineprofiles.id_user',Auth::user()->id)->get();
        $citas = Cita::where('id_paciente','=',Auth::user()->id)->get();

        //return view('pdf',['profile'=>$profile,'vaccineprofile'=>$vaccineprofile,'sviravaccine'=>$citas]);


        $pdf  =  \PDF::loadView('pdf',['profile'=>$profile,'vaccineprofile'=>$vaccineprofile,'sviravaccine'=>$citas]);
        return $pdf->download('svira.pdf');
    }
}
