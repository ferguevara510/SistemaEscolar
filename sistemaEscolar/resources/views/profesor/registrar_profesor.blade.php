@extends('layouts.app')

@section('content')
<link href="{{ asset('/css/registro.css') }}" rel="stylesheet">

<div>
    <p class="titulo">SEF > Lista de Profesores > Registrar datos Profesor</p>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
<div class="container-registro mt-5">

    <form action="" method="post" action="action('ProfesorController@registrarProfesor') ">

        @csrf

        <div class="form-group form-registro">
            <label>Nombre Profesor</label>
            <input type="text" class="form-control  $errors->has('nombreProfesor') ? 'error' : '' " name="nombreProfesor" id="nombreProfesor">
            @if ($errors->has('nombreProfesor'))
            <div class="error">
                {{$errors->first('nombreProfesor')}}
            </div>
            @endif
        </div>

        <div class="form-group form-registro">
            <label>Apellidos Profesore</label>
            <input type="text" class="form-control  $errors->has('apellidosProfesor') ? 'error' : '' " name="apellidosProfesor" id="apellidosProfesor">
            @if ($errors->has('apellidosProfesor'))
            <div class="error">
                {{$errors->first('apellidosProfesor')}}
            </div>
            @endif
        </div>

        <div class="form-group form-registro">
            <label>No. Personal</label>
            <input type="text" class="form-control  $errors->has('noPersonal') ? 'error' : '' " name="noPersonal" id="noPersonal">
            @if ($errors->has('noPersonal'))
            <div class="error">
                {{$errors->first('noPersonal')}}
            </div>
            @endif
        </div>

        <div class="form-group form-registro">
            <label>Correo Institucional</label>
            <input type="email" class="form-control  $errors->has('correoInstitucional') ? 'error' : '' " name="correoInstitucional"
                id="correoInstitucional">
            @if ($errors->has('correoInstitucional'))
            <div class="error">
                {{$errors->first('correoInstituional')}}
            </div>
            @endif
        </div>

        <div class="form-group form-registro">
            <label>Contraseña Profesor</label>
            <input type="text" class="form-control  $errors->has('contrasena') ? 'error' : '' " name="contrasena" id="contrasena">
            @if ($errors->has('contrasena'))
            <div class="error">
                {{$errors->first('contrasena')}}
            </div>
            @endif
        </div>

        <div class="form-group form-registro">
            <label>Licenciatura</label>
            <select class="form-control  $errors->has('licenciatura') ? 'error' : '' " name="licenciatura" id="licenciatura">
                @foreach ($enumLicenciatura as $licenciatura)
                <option value="{{$licenciatura}}">{{$licenciatura}}</option>
                @endforeach
            </select>
            @if ($errors->has('licenciatura'))
            <div class="error">
                {{$errors->first('licenciatura')}}
            </div>
            @endif
        </div>

        <div class="form-group form-registro">
            <label>Area Academica</label>
            <select class="form-control  $errors->has('areaAcademmica') ? 'error' : '' " name="areaAcademica" id="areaAcademica">
                @foreach ($enumAreaAcademica as $areaAcademica)
                <option value="{{$areaAcademica}}">{{$areaAcademica}}</option>
                @endforeach
            </select>
            @if ($errors->has('areaAcademica'))
            <div class="error">
                {{$errors->first('areaAcademica')}}
            </div>
            @endif
        </div>

        <div class="form-group form-registro">
            <label>Entidad</label>
            <select class="form-control  $errors->has('entidad') ? 'error' : '' " name="entidad" id="entidad">
                @foreach ($enumEntidad as $entidad)
                <option value="{{$entidad}}">{{$entidad}}</option>
                @endforeach
            </select>
            @if ($errors->has('entidad'))
            <div class="error">
                {{$errors->first('entidad')}}
            </div>
            @endif
        </div>

        <div class="form-group form-registro">
            <label>Region</label>
            <select class="form-control  $errors->has('region') ? 'error' : '' " name="region" id="region">
                @foreach ($enumRegion as $region)
                <option value="{{$region}}">{{$region}}</option>
                @endforeach
            </select>
            @if ($errors->has('region'))
            <div class="error">
                {{$errors->first('region')}}
            </div>
            @endif
        </div>

        <div class="div-btn-submit">
            <input type="submit" name="send" value="Submit" class="btn-submit">
        </div>
    </form>
</div>
@endsection