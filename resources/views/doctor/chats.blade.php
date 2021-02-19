@extends('layouts.app_doctor')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <strong class="text-secondary">CHATS DISPONIBLES</strong>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <form action="{{route('accept-chat')}}" method="POST">
        @if($chats)
            <ul class="p-0 m-0">
                @foreach ($chats as $key => $value)
                    <li class="card">
                        <button type="submit" class="card-body btn btn-outline-primary justify-content-between d-flex" onclick="return confirm('¿Atender a {{$value->name}}?')">
                            
                                <input type="text" name="id_chat" value="{{$value->id}}" class="d-none">
                                @csrf
                                <div>
                                    {{$value->name}}
                                </div>
                                <div class="text-success">
                                    {{$value->state}}
                                </div>
                                        
                        </button>
                                 
                    </li>
                @endforeach

            </ul>
        @endif
        
    </form>

</div>

@push('styles')
   
@endpush

@push('scripts')
    <script>
        const id_user = {{Auth::user()->id}}
        var username = "{{Auth::user()->name}}"
    </script>
    <script src="{{ asset('js/chat.js') }}" defer></script>  
    
@endpush
@endsection