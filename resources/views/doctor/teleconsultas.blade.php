@extends('layouts.app_doctor')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Citas pendientes</strong>
                </div>
                <div class="card-body">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                
                                <th>Tipo</th>
                                <th>Paciente</th>
                                <th>DNI</th>
                                <th>Especialidad</th>
                                <th>Fecha programada</th>
                                <th>Via</th>
                                <th>Link</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teleconsultas as $item)
                                <tr>
                                
                                    <!--<td> {{$item->id}}</td>-->
                                    <td>Teleconsulta</td>
                                    <td> {{$item->doctorname}}</td>
                                    <td> {{$item->dni}}</td>
                                    <td> {{$item->especialidad}}</td>
                                    <td> {{$item->fecha_programada}}</td>
                                    <td> Google Meets</td>
                                    <td> {{$item->link_google}}</td>
                                    <td class="d-flex">
                                        <a class="btn btn-success mx-1" id="btn-actualizar" name="{{$item->id}}">
                                            Atender
                                        </a>
                                        <a class="btn btn-danger mx-1" id="btn-terminar" name="{{$item->id}}">Finalizar</a>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection