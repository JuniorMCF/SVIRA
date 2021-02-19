@extends('layouts.app_home')

@section('content')
<div class="container">

    <div class="row">
        <div class="form-group col-md-8">
            <button class="btn btn-success" data-toggle="modal" data-target="#modalForm" id="Modal_button">Reservar Teleconsulta</button>
        </div>
    </div>


    <div class="row justify-content-center">
        
       
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Reservas teleconsulta</strong>
                </div>
                <div class="card-body">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                
                                <th>Tipo</th>
                                <th>Médico</th>
                                <th>Especialidad</th>
                                <th>Fecha programada</th>
                                <th>Via</th>
                                <th>Link</th>
                            </tr>
                        </thead>
                        <tbody id="table-citas">
                            @foreach ($teleconsultas as $item)
                                <tr>
                                
                                    <!--<td> {{$item->id}}</td>-->
                                    <td>Teleconsulta</td>
                                    <td> {{$item->doctorname}}</td>
                                    <td> {{$item->especialidad}}</td>
                                    <td> {{$item->fecha_programada}}</td>
                                    <td> Google Meets</td>
                                    <td> {{$item->link_google}}</td>
                                    
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
</div>


<div class="container-fluid chat">
    <div class="row justify-content-end">
        <div class="col-9 col-md-5 col-lg-3 pr-0">
            <div class="card">
                <div class="card-header bg-success d-flex justify-content-between" id="accordionExample">
                    <div class="card-title text-white align-self-center my-0"><h5 class="my-0">Chat Médico</h5></div>
                    <a class="btn btn-success" data-toggle="collapse" href="#collapseOne">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                          </svg>
                    </a>
                </div>
                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                    <div class="card-body p-0" >
                        <ul id="chat-content" class="mb-0">
                            
                        </ul>
                    </div>
                </div>

                <div class="card-footer m-0 p-0 d-flex">

                    <div id="parameters-chat" class="d-none">
                        <input type="text" name="from_user" id="from_user" value="{{Auth::user()->id}}" disabled class="d-none">
                        <input type="text" name="to_user" id="to_user" value="all" disabled class="d-none">
                        
                    </div>
                    <input  type="text" name="message"  id="message" class="form-control">

                    <button class="btn btn-outline-success" type="button" id="send-message">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                            <path d="M12.14 8.753l-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                        </svg>
                    </button>
                    
                </div>
               

            </div>
        </div>
    </div>
</div>

 <!--modal for medical appointment-->
 <div class="modal fade" id="modalForm" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Teleconsulta</h4>
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
                            <label for="via">Via</label>
                            <input class="form-control" type="text" name="via" id="via" value="Google Meets" disabled>
                               
                        </div>
                    </div>
               
                    
                    <div class="form-row">
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
                    </div>
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
                        <strong>Precio: S./80.00</strong>
                    </div>
                </div>
            </div> <!-- Modal footer -->
            <div class="modal-footer ">                    
                <button type="button" class="btn btn-success box-shadow--16dp" data-dismiss="modal" id="accept-pago">OK</button>
                <button type="button" class="btn btn-outline-secondary modal_footer" data-dismiss="modal">Cancel</button> </div>
            </div>
        </div>
    </div>





@push('styles')
    <link href="{{ asset('css/chat.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script>
        const id_user = {{Auth::user()->id}}
        var username = "{{Auth::user()->name}}"
    </script>
    <script src="{{ asset('js/chat.js') }}" defer></script>  
    
@endpush
@endsection