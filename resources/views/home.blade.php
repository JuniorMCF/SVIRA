@extends('layouts.app_home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('SVIRA PLATFORM') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                          <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                          <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                          <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active" >
                                <img src="{{url('storage/portada2.png')}}" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block content">
                                    <h4 class="font-weight-bold text-warning">Evitemos la propagación de la COVID-19</h4>
                                    <p>Recuerda mantener tu distancia y lavarte bien las manos.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="{{url('storage/portada1.png')}}" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block content">
                                    <h4 class="font-weight-bold text-warning">¿Que son los virus?</h4>
                                
                                    <p>Los virus son gérmenes muy pequeños. Están hechos de material genético dentro de un recubrimiento de proteína. Los virus causan enfermedades infecciosas comunes como el resfrío común, la gripe y las verrugas. También causan enfermedades graves como el VIH y sida, el ébola y la COVID-19.</p>
                                </div>
                            </div>
                            
                            <div class="carousel-item">
                                <img src="{{url('storage/portada3.png')}}" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block content">
                                    <h4 class="font-weight-bold text-warning">¿Que son las vacunas?</h4>
                                    <p class="text-">Las vacunas son aquellas preparaciones (producidas con toxoides, bacterias, virus atenuados, muertos o realizadas por ingeniería genética y otras tecnologías) que se administran a las personas para generar inmunidad activa y duradera contra una enfermedad estimulando la producción de defensas.</p>
                                </div>
                            </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                            </a>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
