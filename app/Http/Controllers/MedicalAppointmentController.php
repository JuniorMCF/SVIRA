<?php

namespace App\Http\Controllers;

use App\Mail\NotificationReceived;
use App\Models\Cita;
use App\Models\Especialidad;
use App\Models\Farmaceutica;
use App\Models\Hospital;
use App\Models\User;
use App\Models\Vaccine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MedicalAppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $hospitales = Hospital::all();
        
        $especialidades = Especialidad::all();

        $citas = Cita::select('users.name as doctorname','citas.vacuna','citas.farmaceutica','citas.dosis_actual','citas.dosis_proxima','citas.fecha_programada','citas.fecha_ultima_dosis','citas.hospital','citas.piso','citas.consultorio','citas.estado')->join('users','users.id','=','citas.id_doctor')->where("citas.id_paciente","=",Auth::user()->id)->get();

        $vacunas = Vaccine::all();

        $farmaceuticas = Farmaceutica::all();

        $especialistas = User::where("role","=","admin")->get();


        return view('medicalappointment',["especialidades"=>$especialidades,"especialistas"=>$especialistas,'hospitales'=>$hospitales,'citas'=>$citas,'vacunas'=>$vacunas,'farmaceuticas'=>$farmaceuticas]);
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
        //
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

    public function saveCita(Request $request){


        $existe = Cita::where('id_paciente','=',Auth::user()->id)->where('vacuna','=',$request->vacuna)->get();


        if(count($existe)>0){
            return response()->json(["info"=>"Ya existe una cita asociada a dicha vacuna"],201);
        }

        $cita = new Cita();

        $date = strtotime($request->fec_programada);
    
        $datetime =  date('Y-m-d H:m:s',$date);

        $request->merge([
            'fec_programada' => $datetime,
        ]);


        $cita->tipo = "cita";
        //$cita->descripcion = $request->description;
        $cita->id_doctor = $request->doctor;
        $cita->id_paciente = Auth::user()->id;
        $cita->especialidad = $request->especialidad;
        $cita->hospital = $request->hospital;

        $cita->dosis_actual = "0";
        $cita->dosis_proxima = "1";

        $cita->piso = "3";
        $cita->consultorio = "301";

        $cita->vacuna = $request->vacuna;
        $cita->farmaceutica = $request->farmaceutica;

        $cita->estado = "pendiente";

        $cita->fecha_programada = $request->fec_programada;
        $cita->save();

        //aqui enviamos una notificacion al correo electronico, del registro de la cita

        Mail::to(Auth::user()->email)->send(new NotificationReceived($cita));


        $citas = Cita::select('users.name as doctorname','citas.vacuna','citas.farmaceutica','citas.dosis_actual','citas.dosis_proxima','citas.fecha_programada','citas.fecha_ultima_dosis','citas.hospital','citas.piso','citas.consultorio','citas.estado')->join('users','users.id','=','citas.id_doctor')->where("citas.id_paciente","=",Auth::user()->id)->get();

        return response()->json(["citas"=>$citas],200);
    }
}
