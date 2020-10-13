@extends('layouts.app')
@section('content')

<div class="container">
    <div class="card">
        <form method="POST" action="{{ !isset($user) ? url('/usuarios') : url('/usuarios/' .$user->id) }}">
            <div class="card-header">
                <h2>
                    <!--De igual manera si hay un array carga el titulo Actualizar -->
                    @if(isset($user))
                    Actualizar usuario
                    @method('PUT')
                    @else
                    @method('POST')
                    Registro de usuario
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
                            <label for="exampleInputEmail1"><i class="fa fa-id-card" aria-hidden="true"></i> Nombre:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{isset($user) ? $user->name :old('name')}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><i class="fa fa-id-card" aria-hidden="true"></i> Apellidos:</label>
                            <input type="text" class="form-control" id="surname" name="surname" value="{{isset($user) ? $user->surname :old('surname')}}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><i class="fa fa-id-card" aria-hidden="true"></i> Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{isset($user) ? $user->email :old('email')}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><i class="fa fa-id-card" aria-hidden="true"></i> Tipo usuario:</label>
                            <select type="text" class="form-control" id="tUsuario" name="tUsuario">
                                <option value=""> Seleccionar tipo usuario</option>
                                <option @if(isset($user)) {{ $user->role == 1  ? 'selected' : ''}} @else {{old('role') == 1 ? 'selected' : '' }} @endif value="1"> Administrador</option>
                                <option @if(isset($user)) {{ $user->role == 2  ? 'selected' : ''}} @else {{old('role') == 2 ? 'selected' : '' }} @endif value="2"> Solicitante</option>
                                <option @if(isset($user)) {{ $user->role == 3  ? 'selected' : ''}} @else {{old('role') == 3 ? 'selected' : '' }} @endif value="3"> Despachador</option>

                                <select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><i class="fa fa-id-card" aria-hidden="true"></i> Servicio:</label>
                            <select type="text" class="form-control" id="servicio" name="servicio">
                                <option value=""> Seleccionar Servicio</option>
                                <option @if(isset($user)) {{ $user->servicio == "Financiero"  ? 'selected' : ''}} @else {{old('servicio') == "Financiero" ? 'selected' : '' }} @endif value="Financiero"> Financiero</option>
                                <option @if(isset($user)) {{ $user->servicio == "Laboratorio"  ? 'selected' : ''}} @else {{old('servicio') == "Laboratorio" ? 'selected' : '' }} @endif value="Laboratorio"> Laboratorio</option>
                                <option @if(isset($user)) {{ $user->servicio ==  "Farmacia"  ? 'selected' : ''}} @else {{old('servicio') == "Farmacia" ? 'selected' : '' }} @endif value="Farmacia"> Farmacia</option>
                                <select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><i class="fa fa-id-card" aria-hidden="true"></i> Contraseña:</label>
                            <input class="form-control" type="password" name="password" id="password" placeholder="********" value="{{old('password')}}">
                        </div>
                    </div>
                </div>
                <br>
                <div>
                    <div style="text-align: right">
                        <a href="{{url('/usuarios')}}" class="btn btn-warning">Cancelar </a>
                        <button type="submit" class=" btn btn-primary">Guardar </button>
                    </div>
                </div>
        </form>
    </div>
</div>
</div>

@endsection