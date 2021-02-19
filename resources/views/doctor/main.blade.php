@extends('layouts.app_doctor')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <strong>Bienvenido  {{Auth::user()->name}}</strong>
                </div>
    
            </div>
        </div>
        

    </div>

</div>

@push('styles')

@endpush

@push('scripts')

    
@endpush
@endsection