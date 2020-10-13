@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body center">
                    <h2 >
                    ¡Bienvenido {{Auth::user()->name}}!
                    </h2>
                </div>

                <div class="card-body">
                   <img class="imgHome" src="{{asset('imagenes/CI.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
