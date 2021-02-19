@extends('layouts.app_home')

@section('content')
<div class="container">

    <div class="row justify-content-start my-2">
        <div class="col-12">
            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#modalVaccine" data-backdrop="static">Agregar vacuna a su historial</button>
            <a href="{{route('imprimir')}}" class="btn btn-outline-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
              </svg> imprimir ficha</a>
        </div>
    </div>

    <div id="pdf">
        <div class="row justify-content-center">
            <strong class="card-title">FICHA DE VACUNACIÖN SVIRA</strong>
        </div>
    
        <div class="row justify-content-center">
            

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Historial de vacunación</strong>
                    </div>
                    <div class="table-responsive p-0" >
                        <table class="table table-bordered vaccine-datatable">
                            <thead>
                                <tr>
                                    <!--<th>No</th>-->
                                    <th>Paciente</th>
                                    <th>Vacuna</th>
                                    <th>Tipo</th>
                                    <th>dosis recibidas</th>
                                    <th>dosis faltantes</th>
                                    <th>Hospital</th>

                                    <th>Fecha ult dosis</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="row justify-content-center mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Vacunas SVIRA</strong>
                    </div>
                    <div class="card-body" >
                                    <table class="table table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Paciente</th>
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
                                            </tr>
                                        </thead>
                                        <tbody>
                
                                            @foreach ($vaccinesconcluidas as $item)
                                                <tr>
                                                
                                                    <!--<td> {{$item->id}}</td>-->
                                                    <td> {{$item->doctorname}}</td>
                                                    <td> {{$item->vacuna}}</td>
                                                    <td> {{$item->farmaceutica}}</td>
                                                    <td> {{$item->dosis_actual}}</td>
                                                    <td> {{$item->dosis_proxima}}</td>
                                                    <td> {{$item->doctorname}}</td>
                                                    <!--<td> {{$item->especialidad}}</td>-->
                                                    <td> {{$item->fecha_programada}}</td>
                                                    <td> {{$item->fecha_programada}}</td>
                                                    <td> {{$item->hospital}}</td>
                                                    <td> {{$item->piso}}</td>
                                                    <td> {{$item->consultorio}}</td>
                                                </tr>
                                            @endforeach
                
                                        </tbody>
                                    </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--modal for add vaccine-->

    <div class="modal" id="modalVaccine" tabindex="-1" role="dialog" aria-labelledby="modalVaccineLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="modalVaccineLabel"><strong>Información sobre la vacuna</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('vaccine-profile-update') }}">
                        @csrf
                        <input type="text" name="id_user" class="d-none" value="{{Auth::user()->id}}" >
                        <input type="text" name="nombre_paciente" class="d-none" value="{{Auth::user()->name}}" >

                        <div class="form-row">
                            <div class="form-group col-md-12">
                              <label for="vacuna">Tipo de vacuna</label>
                              <select  name="id_vaccine" class="custom-select" aria-label="Default select example">
                                  <option selected>Seleccionar vacuna</option>
                                  @if (isset($vaccines))
                                        @foreach ($vaccines as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                  @endif
                                </select>
                            </div>
                        </div>
                       
                        <div class="form-row">
                            {{--<div class="form-group col-md-6">
                                <label for="vacuna">Tipo de inmunización</label>
                                <select class="custom-select" aria-label="Default select example">
                                    <option selected>Seleccionar tipo</option>
                                    <option value="1">Anual</option>
                                    <option value="2">Semestral</option>
                                    <option value="3">Trimestral</option>
                                </select>
                            </div>--}}

                            <div class="form-group col-md-12">
                                <label for="vacuna">Dosis recibidas</label>
                                <select name="dosis" class="custom-select" aria-label="Default select example">
                                    <option selected>Seleccionar cantidad</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                          
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="hospital">Hospital de registro</label>
                                <input type="text" id="hospital" name="hospital" class="form-control" placeholder="Ingrese el hospital donde se hizo la inmunización">
                            </div>
                        </div>



                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="date">Fecha de la ultima dosis recibida</label>
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" name="fec_inmun">
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

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
      
</div>

@push('styles')
    <!-- Datepicker Files -->
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker.standalone.css')}}">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.3.5/css/autoFill.dataTables.min.css">
@endpush

@push('scripts')
   
    <!-- Datepicker Files -->
    <script src="{{asset('datePicker/js/bootstrap-datepicker.js')}}" defer></script>
    <!-- Languaje -->
    <script src="{{asset('datePicker/locales/bootstrap-datepicker.es.min.js')}}" defer></script>

   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>

    <script>
        
        function pruebaDivAPdf() {
            var pdf = new jsPDF('p', 'pt', 'a4',true);
            source = $('#pdf')[0];

            specialElementHandlers = {
                '#bypassme': function (element, renderer) {
                    return true
                }
            };
            margins = {
                top: 20,
                bottom: 20,
                left: 20,
                width: 600
            };

            pdf.fromHTML(
                source, 
                margins.left, // x coord
                margins.top, { // y coord
                    'width': margins.width, 
                    'elementHandlers': specialElementHandlers
                },

                function (dispose) {
                    pdf.save('Prueba.pdf');
                }, margins
            );
        }
    </script>

    <script defer>
        const vaccineurl = "{{ route('vaccine.list') }}"
    </script>

    <script src="{{ asset('js/vaccine.js') }}" defer></script>  
    
   
@endpush
@endsection