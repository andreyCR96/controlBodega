@extends('layouts.app')
@section('content')

<div class="container">
    <div class="card">
        <form method="POST" action="{{ !isset($producto) ? url('/productos') : url('/productos/' .$producto->id) }}">
            <div class="card-header">
                <h2>
                    <!--De igual manera si hay un array carga el titulo Actualizar -->
                    @if(isset($producto))
                    Actualizar producto
                    @method('PUT')
                    @else
                    @method('POST')
                    Registro de producto
                    @endif
                </h2>
            </div>
            <!--  Muestra la accion que se realizo-->
            @if(session('status'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <strong> {{session('status')}} </strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <!-- Muestra la validadciones si exiten-->
            @if($errors->any())
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="card-body">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><i class="fa fa-id-card" aria-hidden="true"></i> Código:</label>
                            <input type="text" class="form-control" id="codigo" name="codigo" value="{{isset($producto) ? $producto->codigo :old('codigo')}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><i class="fa fa-id-card" aria-hidden="true"></i> Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{isset($producto) ? $producto->codigo :old('nombre')}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><i class="fa fa-id-card" aria-hidden="true"></i> Unidad:</label>
                            <select type="text" class="form-control" id="unidad" name="unidad">
                                <option value=""> Seleccionar tipo de Unidad</option>
                                <option @if(isset($producto)) {{ $producto->unidad == "UD"  ? 'selected' : ''}} @else {{old('unidad') == "UD" ? 'selected' : '' }} @endif value="UD"> UD</option>
                                <option @if(isset($producto)) {{ $producto->unidad == "UDS"  ? 'selected' : ''}} @else {{old('unidad') == "UDS" ? 'selected' : '' }} @endif value="UDS"> UDS</option>
                                <option @if(isset($producto)) {{ $producto->unidad == "PRS"  ? 'selected' : ''}} @else {{old('unidad') == "PRS" ? 'selected' : '' }} @endif value="PRS"> PRS</option>
                                <select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><i class="fa fa-id-card" aria-hidden="true"></i> Ubicación:</label>
                            <input class="form-control" type="text" name="ubicacion" id="ubicacion" value="{{isset($producto) ? $producto->ubicacion :old('ubicacion')}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><i class="fa fa-id-card" aria-hidden="true"></i> Descripcion:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{isset($producto) ? $producto->codigo :old('descripcion')}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><i class="fa fa-id-card" aria-hidden="true"></i> ID Lote:</label>
                            <input class="form-control" type="text" name="id_lote" id="id_lote" value="{{isset($producto) ? $producto->id_Lote :old('id_lote')}}">
                        </div>
                    </div>
                </div>
                <br>
                <div>
                    <div style="text-align: right">
                        <a href="{{url('/productos')}}" class="btn btn-warning">Cancelar </a>
                        <button type="submit" class=" btn btn-primary">Guardar </button>
                    </div>
                </div>
        </form>
    </div>
</div>
@endsection