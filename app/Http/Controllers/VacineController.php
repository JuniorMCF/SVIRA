<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Vaccine;
use App\Models\VacineProfile;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VacineController extends Controller
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
        $vaccines = Vaccine::all();

        $vaccinesconcluidas = Cita::select('users.name as doctorname','citas.vacuna','citas.farmaceutica','citas.dosis_actual','citas.dosis_proxima','citas.fecha_programada','citas.fecha_ultima_dosis','citas.hospital','citas.piso','citas.consultorio')->join('users','users.id','=','citas.id_paciente')->where("citas.id_paciente","=",Auth::user()->id)->where("citas.dosis_actual",">",0)->get();

        return view('vaccine',['vaccines'=>$vaccines,'vaccinesconcluidas'=>$vaccinesconcluidas]);
    }

    public function getVaccine(){

        //var_dump( VacineProfile::all() );'nombre_paciente' },
        


        return  datatables( VacineProfile::select('vacineprofiles.id','vacineprofiles.nombre_paciente','vaccines.name as vacuna','vaccines.tipo as tipo_inmun','vacineprofiles.dosis','vaccines.dosis as dosis_totales','vacineprofiles.hospital','vacineprofiles.fec_inmun')->join('vaccines','vaccines.id','=','vacineprofiles.id_vaccine')->where('vacineprofiles.id_user',Auth::user()->id)->get())->toJson();
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
    public function update(Request $request)
    {
        //

        
        $date = strtotime($request->fec_inmun);
    
        $datetime =  date('Y-m-d H:m:s',$date);

        $request->merge([
            'fec_inmun' => $datetime,
        ]);

        $vaccineprofile = VacineProfile::create($request->except(['_token']));

        return back();
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
}
