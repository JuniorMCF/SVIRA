@extends('layouts.app_doctor')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success alert-block d-none" id="container-alert-message">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong id="message-alert"></strong>
            </div>
        </div>
        
    </div>

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
                                <!--<th>Nro</th>-->
                                <th>Paciente</th>
                                <th>Vacuna</th>
                                <th>Farmacéutica</th>
                                <th>Última dosis</th>
                                <th>Próxima dosis</th>
                                <th>DNI</th>
                                <!--<th>Especialidad</th>-->
                                <th>Fecha ultima vacuna</th>
                                <th>Fecha próxima vacuna</th>
                                <th>Hospital</th>
                                <th>Piso</th>
                                <th>Consultorio</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="table-citas">

                            @foreach ($citas as $item)
                                <tr>
                                
                                    <!--<td> {{$item->id}}</td>-->
                                    <td> {{$item->doctorname}}</td>
                                    <td> {{$item->vacuna}}</td>
                                    <td> {{$item->farmaceutica}}</td>
                                    <td> {{$item->dosis_actual}}</td>
                                    <td> {{$item->dosis_proxima}}</td>
                                   
                                    <td> {{$item->dni}}</td>
                                    <!--<td> {{$item->especialidad}}</td>-->
                                    <td> {{$item->fecha_ultima_dosis}}</td>
                                    <td> {{$item->fecha_programada}}</td>
                                    <td> {{$item->hospital}}</td>
                                    <td> {{$item->piso}}</td>
                                    <td> {{$item->consultorio}}</td>
                                    <td class="d-flex">
                                        <a class="btn btn-success mx-1" id="btn-actualizar" name="{{$item->id}}">
                                            actualizar
                                        </a>
                                        <a class="btn btn-danger mx-1" id="btn-terminar" name="{{$item->id}}">terminar</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                                        

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="modalForm" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Inmunización</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Close</span>
                    </button>
                    
                </div>
                
                <!-- Modal Body -->
                <form method="POST" action="{{ route('citas-update') }}">
                <div class="modal-body">
                    
                        @csrf
                        <input type="text" class="form-control d-none" name="id" id="id" placeholder="" >
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="paciente">Paciente</label>
                                <input type="text" class="form-control" name="paciente" id="paciente" placeholder="" disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="vacuna">Vacuna</label>
                                <input type="text" class="form-control" name="vacuna" id="vacuna" placeholder="" disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="farmaceutica">Farmaceutica</label>
                                <input type="text" class="form-control" name="farmaceutica" id="farmaceutica" placeholder="" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="dosis_actual">Dosis actual recibida</label>
                              <input type="text" class="form-control" name="dosis_actual" id="dosis_actual" placeholder="dosis actual" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="dosis_programada">Siguiente dosis</label>
                                <input type="text" class="form-control" name="dosis_programada" id="dosis_programada" placeholder="siguiente dosis">
                              </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="fecha_ultima_dosis">fecha actual de inmunización</label>
                              
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" name="fecha_ultima_dosis" id="fecha_ultima_dosis" value="{{date("Y-m-d H:i:s")}}" >
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                                                <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z"/>
                                                <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                            </svg>
                                        </span>
                                    </div>   
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="fecha_programada">fecha para la siguiente dosis</label>
                              
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" name="fecha_programada" id="fecha_programada">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                                                <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z"/>
                                                <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                            </svg>
                                        </span>
                                    </div>   
                                </div>
                            </div>
                        </div>

                    
                </div>
                
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <input class="btn btn-primary" type="submit" value="Actualizar vacuna" onclick="alert('¿Seguro que quiere actualizar el estado de la vacuna?');">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
                </form>
            </div>
        </div>
    </div>


</div>
@push('styles')
    <!-- Datepicker Files -->
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker.standalone.css')}}">
 @endpush  

@push('scripts')
    <!-- Datepicker Files -->
    <script src="{{asset('datePicker/js/bootstrap-datepicker.js')}}" defer></script>
    <!-- Languaje -->
    <script src="{{asset('datePicker/locales/bootstrap-datepicker.es.min.js')}}" defer></script>
    <script src="{{ asset('js/citas.js') }}" defer ></script>  
    
@endpush

@endsection