@extends('layouts.footer')
@extends('layouts.menus.app_profesor')
@section('content')

<link href="{{ asset('/css/registro.css') }}" rel="stylesheet">

<div>
    <p class="titulo">SEF > Lista de Estudiantes > Modificar datos Estudiante</p>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
<div class="container-registro mt-5">

    <form method="post" action="{{route('estudianteProfEdit', $estudiante->id)}}">
        @method('PUT')
        @csrf

        <div class="form-group form-registro">
            <label>Nombre Estudiante</label>
            <input value="{{$estudiante->nombreEstudiante}}" type="text" class="form-control  $errors->has('nombreEstudiante') ? 'error' : '' " name="nombreEstudiante" id="nombreEstudiante">
            @if ($errors->has('nombreEstudiante'))
            <div class="error">
                {{$errors->first('nombreEstudiante')}}
            </div>
            @endif
        </div>

        <div class="form-group form-registro">
            <label>Apellidos Estudiante</label>
            <input value="{{$estudiante->apellidosEstudiante}}" type="text" class="form-control  $errors->has('apellidosEstudiante') ? 'error' : '' " name="apellidosEstudiante" id="apellidosEstudiante">
            @if ($errors->has('apellidosEstudiante'))
            <div class="error">
                {{$errors->first('apellidosEstudiante')}}
            </div>
            @endif
        </div>

        <div class="form-group form-registro">
            <label>Matricula</label>
            <input value="{{$estudiante->matricula}}" type="text" class="form-control  $errors->has('matricula') ? 'error' : '' " name="matricula" id="matricula">
            @if ($errors->has('matricula'))
            <div class="error">
                {{$errors->first('matricula')}}
            </div>
            @endif
        </div>

        <div class="form-group form-registro">
            <label>Correo Institucional</label>
            <input value="{{$estudiante->correoInstitucional}}" type="email" class="form-control  $errors->has('correoInstitucional') ? 'error' : '' " name="correoInstitucional"
                id="correoInstitucional">
            @if ($errors->has('correoInstitucional'))
            <div class="error">
                {{$errors->first('correoInstituional')}}
            </div>
            @endif
        </div>

        <div class="form-group form-registro">
            <label>Contraseña Estudiante</label>
            <input value="{{$estudiante->contrasena}}" type="text" class="form-control  $errors->has('contrasena') ? 'error' : '' " name="contrasena" id="contrasena">
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
                @if ($estudiante->licenciatura === $licenciatura)
                <option selected value="{{$licenciatura}}">{{$licenciatura}}</option>
                @else
                <option value="{{$licenciatura}}">{{$licenciatura}}</option>
                @endif          
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
                @if ($estudiante->areaAcademica === $areaAcademica)
                <option selected value="{{$areaAcademica}}">{{$areaAcademica}}</option>
                @else
                <option value="{{$areaAcademica}}">{{$areaAcademica}}</option>
                @endif          
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
                @if ($estudiante->entidad === $entidad)
                <option selected value="{{$entidad}}">{{$entidad}}</option>
                @else
                <option value="{{$entidad}}">{{$entidad}}</option>
                @endif          
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
                @if ($estudiante->region === $region)
                <option value="{{$region}}">{{$region}}</option>
                @else
                <option value="{{$region}}">{{$region}}</option>
                @endif          
                @endforeach
            </select>
            @if ($errors->has('region'))
            <div class="error">
                {{$errors->first('region')}}
            </div>
            @endif
        </div>

        <div class="div-btn-submit">
            <input type="submit" name="send" value="Modificar ✍️" class="btn-opcion btn-opcion-color">
        </div>
    </form>
</div>
@endsection