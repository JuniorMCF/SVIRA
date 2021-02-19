@extends('layouts.app_doctor')

@section('content')

<div class="container chat">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header bg-primary d-flex justify-content-between" id="accordionExample">
                    <div class="card-title text-white align-self-center my-0"><h5 class="my-0">Chat Médico</h5></div>
                    <a class="btn btn-primary" data-toggle="collapse" href="#collapseOne">
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
                        <input type="text" name="to_user" id="to_user" value="{{$id_user}}" disabled class="d-none">
                        
                    </div>
                    <input  type="text" name="message"  id="message" class="form-control">

                    <button class="btn btn-outline-primary" type="button" id="send-message">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                            <path d="M12.14 8.753l-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                        </svg>
                    </button>
                    
                </div>
               

            </div>
        </div>
    </div>
</div>

@push('styles')
    <link href="{{ asset('css/salachat.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script>
        const id_user = {{Auth::user()->id}}
        const id_chat = {{$id_chat}}
        var username = "{{Auth::user()->name}}"
    </script>
    <script src="{{ asset('js/salachat.js') }}" defer></script>  
    
@endpush
@endsection