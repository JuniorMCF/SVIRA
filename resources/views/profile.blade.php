@extends('layouts.app_home')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(session()->has('message'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>{{ session()->get('message') }}</strong>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Datos personales</strong>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile-update') }}"
                    enctype="multipart/form-data">
                        @csrf
                        <input type="text" class="form-control d-none" name="id" id="id" placeholder="" value="{{Auth::user()->id}}">
                        <div class="form-row">
                          <div class="form-group col-md-12">
                            <label for="name">DNI</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="" value="{{Auth::user()->dni}}" disabled>
                          </div>
                         
                        </div>

                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="name">Nombres y apellidos</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="" value="{{Auth::user()->name}}">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="" value="{{Auth::user()->email}}" disabled>
                          </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="address">Dirección</label>
                              <input type="text" class="form-control" name="address" id="address" placeholder="Dirección" value="{{ $profile->address }}">
                            </div>
                            <div class="form-group col-md-6">
                              <label for="phone_number">Teléfono</label>
                              <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="" value="{{$profile->phone_number}}"  pattern="[5-9]{1}[0-9]{8}" maxlength="9">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                              <label for="age">Edad</label>
                              <input type="text" class="form-control" name="age" id="age" placeholder="(años)" value="{{ $profile->age }}">
                            </div>
                            <div class="form-group col-md-4">
                              <label for="height">Altura</label>
                              <input type="text" class="form-control" name="height" id="height" placeholder="(cm)" value="{{$profile->height}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="weight">Peso</label>
                                <input type="text" class="form-control" name="weight" id="weight" placeholder="(kg)" value="{{$profile->weight}}">
                              </div>
                        </div>
                        @if ($profile->url_image)
                        <div class="form-row">
                          <div class="col-12 col-md-6">
                            <img src="{{$profile->url_image}}" alt="" class="img-fluid" height="">
                          </div>
                        </div>
                            
                        @else
                           <img src="" alt="">
                        @endif

                        <div class="form-row">
                          <div class="form-group col-12">
                            <label for="file">Foto DNI</label>
                            <input name="file" type="file" class="form-control-file" id="file">
                          </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-12 col-md-3">
                                <button type="submit" class="btn btn-block btn-success">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <div class="row justify-content-start mt-2">
        <div class="col">
          <button type="button" class="btn btn-outline-primary" onclick="window.location='{{route('reset-password-profile')}}'">Cambiar contraseña</button>
        </div>
    </div>
</div>

@push('scripts')
    
@endpush
@endsection