@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-5">
            <img src="{{url('storage/logo_svira.png')}}" alt="" class="img-fluid mx-auto d-block" >
        </div>
        <div class="col-12 col-md-6 col-lg-7">
           <h3 class="text-center text-md-left text-danger"><strong>¿Quiénes somos?</strong></h3>
           <h5 class="text-justify text-secondary"> En SVIRA (Sistema de vacunación integral, registro y alerta) somos una plataforma que permite a las personas tener un registro de las vacunas que tiene aplicadas a lo largo de toda su vida, a través de la plataforma usted podrá reservar una cita para ser vacunado y podrá imprimir una ficha de vacunación en caso lo requiera. El sistema le avisará con dias de anticipación, mediante una alerta en su telefono, en caso de tener dosis incompletas de alguna vacuna o cuando se acerque el dia de su cita reservada. También contamos con servicios de consulta por chat o videollamada, con nuestro personal médico altamente capacitado, prestos a antender cualquier duda o consulta.</h5>
        </div>
    </div>
</div>
@endsection