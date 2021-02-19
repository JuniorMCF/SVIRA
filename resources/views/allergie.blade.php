@extends('layouts.app_home')

@section('content')
<div class="container">

        
    <form action="{{route('allergie-store')}}" method="POST" class="row justify-content-start">
        @csrf
        <input class="d-none" type="text" name="id_user" value="{{Auth::user()->id}}">
        <div class="form-group col-md-4">
            <label for="medicine">Alergía a medicamento</label>
            <select id="medicine" name="medicine" class="custom-select" aria-label="Default select example">
                <option selected>Seleccionar medicamento</option>
                @if (isset($medicines))
                    @foreach ($medicines as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="form-group col-md-8 align-self-end">
            <button class="btn btn-primary">Agregar alergía</button>
        </div>
    </form>

        



    <div class="row justify-content-center">
        
        
       
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Alergias hacia algunos medicamentos</strong>
                </div>
                
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Medicamento</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            @foreach ($allergies as $key => $value)
                                
                                        <td>
                                            {{$value->name}}
                                        </td>
                                        <td>
                                            <button class="btn btn-danger">eliminar</button>
                                        </td>
                                    
                            </tr>   
                            @endforeach
                            
                        </tbody>
                    </table>

                </div>
            </div>
        </div>


    </div>


    <div class="row justify-content-center">
        
       
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Historial de enfermedades</strong>
                </div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>


    </div>
</div>


@push('scripts')
    
@endpush
@endsection