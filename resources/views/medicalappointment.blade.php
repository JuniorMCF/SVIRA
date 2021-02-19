@extends('layouts.app_home')

@section('content')
<div class="container">

    <div class="row">
        <div class="form-group col-md-8">
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalForm" id="Modal_button">Solicitar cita médica para vacunación</button>
        </div>
    </div>

    <div class="row justify-content-center">
        
        <div class="col-md-12 mx-2 alert alert-success alert-block d-none" id="container-alert-message">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong id="message-alert"></strong>
        </div>
       
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Citas médicas pendientes</strong>
                </div>
                <div class="card-body">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                
                                <th>Vacuna</th>
                                <th>Farmacéutica</th>
                                <th>Dosis actual</th>
                                <th>Próxima dosis</th>
                                <th>Médico</th>
                                <!--<th>Especialidad</th>-->
                                <th>Fecha ultima dosis recibida</th>
                                <th>Fecha proxima dosis</th>
                                <th>Hospital</th>
                                <th>Piso</th>
                                <th>Consultorio</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody id="table-citas">

                            @foreach ($citas as $item)
                                <tr>
                                    <td> {{$item->vacuna}}</td>
                                    <td> {{$item->farmaceutica}}</td>
                                    <td> {{$item->dosis_actual}}</td>
                                    <td> {{$item->dosis_proxima}}</td>
                                    <td> {{$item->doctorname}}</td>
                                    <td> {{$item->fecha_ultima_dosis}}</td>
                                    <td> {{$item->fecha_programada}}</td>
                                    <td> {{$item->hospital}}</td>
                                    <td> {{$item->piso}}</td>
                                    <td> {{$item->consultorio}}</td>
                                    <td> {{$item->estado}}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>

<!--
    <div class="row justify-content-center mt-4">
        
       
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Historial de citas médicas</strong>
                </div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>


    </div>
-->
    <!--modal for medical appointment-->
    <div class="modal fade" id="modalForm" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Cita médica</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Close</span>
                    </button>
                    
                </div>
                
                <!-- Modal Body -->
                <div class="modal-body">
                    <form role="form">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="hospital">Hospital</label>
                                <select id="hospital-form" name="hospital" class="custom-select" aria-label="Default select example">
                                    <option selected>Seleccionar hospital</option>
                                    @if (isset($hospitales))
                                        @foreach ($hospitales as $item)
                                            <option value="{{$item->name}}">{{$item->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                   
                        
                        <!--<div class="form-row">
                            <div class="form-group col-md-12">
                              <label for="especialidad">Especialidad</label>
                              <select id="especialidad-form" name="especialidad" class="custom-select" aria-label="Default select example">
                                  <option selected>Seleccionar especialidad</option>
                                  @if (isset($especialidades))
                                        @foreach ($especialidades as $item)
                                            <option value="{{$item->name}}">{{$item->name}}</option>
                                        @endforeach
                                  @endif
                                </select>
                            </div>
                        </div>-->
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="doctor">Médico especialista</label>
                                <select  id="doctor-form" name="doctor" class="custom-select" aria-label="Default select example">
                                    <option selected>Seleccionar médico</option>
                                    @if (isset($especialistas))
                                          @foreach ($especialistas as $item)
                                              <option value="{{$item->id}}">{{$item->name}}</option>
                                          @endforeach
                                    @endif
                                  </select>
                              </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <p for="fec_programada">Fechas disponibles</p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="fec_programada-1" value="11-03-2021 10:00" name="fec_programada">
                                    <label class="form-check-label" for="inlineRadio1" >11-03-2021 10:00</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="fec_programada-2" value="12-03-2021 12:30" name="fec_programada">
                                    <label class="form-check-label" for="inlineRadio2">12-03-2021 12:30</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="fec_programada-3" value="20-03-2021 16:00" name="fec_programada">
                                    <label class="form-check-label" for="inlineRadio3">20-03-2021 16:00</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="fec_programada-4" value="20-03-2021 16:00" name="fec_programada">
                                    <label class="form-check-label" for="inlineRadio4">20-03-2021 16:00</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="doctor">Vacuna</label>
                                <select  id="vacuna-form" name="doctor" class="custom-select" aria-label="Default select example">
                                    <option selected>Seleccionar vacuna</option>
                                    @if (isset($vacunas))
                                          @foreach ($vacunas as $item)
                                              <option value="{{$item->name}}">{{$item->name}}</option>
                                          @endforeach
                                    @endif
                                  </select>
                              </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="doctor">Farmacéutica</label>
                                <select  id="farmaceutica-form" name="doctor" class="custom-select" aria-label="Default select example">
                                    <option selected>Seleccionar farmacéutica</option>
                                    @if (isset($farmaceuticas))
                                          @foreach ($farmaceuticas as $item)
                                              <option value="{{$item->name}}">{{$item->name}}</option>
                                          @endforeach
                                    @endif
                                  </select>
                              </div>
                        </div>

                        <!--<div class="form-group">
                            <label for="comment">¿Qué malestar presenta?</label>
                            <textarea class="form-control" id="comment" placeholder="De una breve descripción de lo que padece (Opcional)"></textarea>
                        </div>-->


                    </form>
                </div>
                
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary submitBtn" data-toggle="modal" data-target="#myModal" id="#myModal">Aceptar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <!--modal for page medic control--->
    <div class="modal fade mt-5" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header"> SVIRA<button type="button" class="close" data-dismiss="modal">&times;</button> </div> <!-- Modal body -->
                <div class="modal-body m-0 p-0">
                    <div class="card p-4 m-0">
                        <!-- custom radio button -->
                        <div class="holder">
                            <div class="row mb-1">
                                <div class="col">
                                    <h2>Método de pago</h2>
                                </div>
                            </div>
                            <form action="#" class="customRadio customCheckbox m-0 p-0">
                                
                                <div class="row mt-0 ml-0">
                                    <div class="col-12 my_checkbox ">
                                        
                                        <div class="d-flex justify-content-between"> <input type="checkbox" id="screenshots"> <label for="screenshots" id="screenshots_label">Transferencia bancaria</label> <img src="{{url('storage/transferencia.jpg')}}" alt="" height="50" class="ml-4 align-self-end"></div>
                                        <div class="d-flex justify-content-between"> <input type="checkbox" id="RAW"> <label for="RAW">Tarjeta de crédito</label><img src="{{url('storage/visa-mastercard.jpg')}}" alt="" height="50" class="ml-4"></div>
                                       
                                    </div>
                                </div>
                                
                            </form>
                        </div>


                        <div>
                            <strong>Precio: S./100.00</strong>
                        </div>
                    </div>
                </div> <!-- Modal footer -->
                <div class="modal-footer ">                    
                    <button type="button" class="btn btn-success box-shadow--16dp" data-dismiss="modal" id="accept-pago">OK</button>
                    <button type="button" class="btn btn-outline-secondary modal_footer" data-dismiss="modal">Cancel</button> </div>
                </div>
            </div>
        </div>

</div>

@push('styles')
    <link href="{{ asset('css/medicalappointment.css') }}" rel="stylesheet">
@endpush


@push('scripts')
    <script src="{{ asset('js/medicalappointment.js') }}" defer></script>  
@endpush

@endsection