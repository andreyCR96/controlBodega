@extends('layouts.app')

@section('content')


<div class="container">
    <div style="padding-bottom:5%">
        <div class="float-left">
            <h1> Módulo de Usuarios </h1>
        </div>
        <div class="float-right">
            <a style="color:azure" href="{{url('/usuarios/create')}}" class="btn btn-primary"> Crear nuevo usuario</a>
        </div>
    </div>
    @if(session('status'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <strong> {{session('status')}} </strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <br>
    <table class="table dataTable display nowrap">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre completo</th>
                <th scope="col">Email</th>
                <th scope="col">Tipo de Usuario</th>
                <th scope="col">Servicio</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)

            <tr>
                <th>{{$user->id}}</th>
                <th>{{$user->name}}</th>
                <th>{{$user->email}}</th>
                <th>
                    @if($user->role == 1)
                    Administrador
                    @elseif($user->role==2)
                    Solicitante
                    @elseif($user->role==3)
                    Despachador
                    @else
                    4
                    @endif
                </th>
                <th>{{$user->servicio}}</th>
                <th>
                    <a class="btn btn-warning" href="{{url('/usuarios/'.$user->id)}}">Editar</a>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$user->id}}">
                        Eliminar
                    </button>
                    <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    ...
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a class="btn btn-danger" href="{{url('/usuarios/delete/'. $user->id) }}">Eliminar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </th>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>


@endsection