@extends('layouts.app')

@section('content')


<div class="container">
    <div style="padding-bottom:5%">
        <div class="float-left">
            <h1> Módulo de Productos</h1>
        </div>
        <div class="float-right">
            <a style="color:azure" href="{{url('/productos/create')}}" class="btn btn-primary"> Crear nuevo producto</a>
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
                <th scope="col">Código</th>
                <th scope="col">Nombre</th>
                <th scope="col">Unidad</th>
                <th scope="col">Ubicación</th>
                <th scope="col">Descripción</th>
                <th scope="col">ID Lote</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <th>{{$producto->codigo}}</th>
                <th>{{$producto->nombre}}</th>
                <th>{{$producto->unidad}}</th>
                <th>{{$producto->ubicacion}}</th>
                <th>{{$producto->descripcion}}</th>
                <th>{{$producto->id_Lote}}</th>
                 <th>
                    <a class="btn btn-warning" href="{{url('/productos/'.$producto->id_Producto)}}" >Editar</a>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$producto->id_Producto}}">
                        Eliminar
                    </button>
                    <div class="modal fade" id="exampleModal{{$producto->id_Producto}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <a class="btn btn-danger" href="{{url('/productos/delete/'. $producto->id_Producto) }}">Eliminar</a>
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