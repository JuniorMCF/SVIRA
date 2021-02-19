<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitasController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('doctor');
    }


    public function index(){


        $citas = Cita::select('users.name as doctorname','users.dni as dni','citas.id','citas.vacuna','citas.farmaceutica','citas.dosis_actual','citas.dosis_proxima','citas.fecha_ultima_dosis','citas.fecha_programada','citas.hospital','citas.piso','citas.consultorio')->join('users','users.id','=','citas.id_paciente')->where("citas.id_doctor","=",Auth::user()->id)->get();


        return view('doctor.citas',["citas"=>$citas]);
    }

    public function citaDetalle($id){

        $cita = Cita::select('users.name as doctorname','users.dni as dni','citas.id','citas.vacuna','citas.farmaceutica','citas.dosis_actual','citas.dosis_proxima','citas.fecha_ultima_dosis','citas.fecha_programada','citas.hospital','citas.piso','citas.consultorio')->join('users','users.id','=','citas.id_paciente')->where("citas.id","=",$id)->first();

        return response()->json(["cita"=>$cita],200);
    }
    public function update(Request $request){

        
        
        $cita = Cita::find($request->id);

        $cita->dosis_actual = $request->dosis_programada - 1;
        $cita->dosis_proxima = $request->dosis_programada;


        $date = strtotime($request->fecha_programada);
    
        $datetime =  date('Y-m-d H:m:s',$date);

        $request->merge([
            'fecha_programada' => $datetime,
        ]);

        $date = strtotime($request->fecha_ultima_dosis);
    
        $datetime =  date('Y-m-d H:m:s',$date);

        $request->merge([
            'fecha_ultima_dosis' => $datetime,
        ]);


        $cita->fecha_ultima_dosis = $request->fecha_ultima_dosis;
        $cita->fecha_programada = $request->fecha_programada;

        $cita->update();

        return back()->with(["success"=>"Próxima dosis programada"]);

    }

    public function citaTerminar(Request $request){
        
        $cita = Cita::find($request->id);

        //return response()->json(["response"=>$request->id],200);

        $prox = $cita->dosis_proxima;
        $cita->dosis_actual = $prox; 

        $date = strtotime('today UTC');
    
        $cita->fecha_ultima_dosis =  date('Y-m-d H:m:s',$date);

        $cita->estado = "terminado";

        $cita->update();


        $citas = Cita::select('users.name as doctorname','users.dni as dni','citas.id','citas.vacuna','citas.farmaceutica','citas.dosis_actual','citas.dosis_proxima','citas.fecha_ultima_dosis','citas.fecha_programada','citas.hospital','citas.piso','citas.consultorio')->join('users','users.id','=','citas.id_paciente')->where("citas.id_doctor","=",Auth::user()->id)->get();

        return response()->json(["citas"=>$citas],200);

    }
    
}
