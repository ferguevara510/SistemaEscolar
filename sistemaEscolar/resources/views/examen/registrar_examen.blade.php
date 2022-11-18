@extends('layouts.footer')
@extends('layouts.menus.app_profesor')
@section('content')

<link href="{{ asset('/css/registro.css') }}" rel="stylesheet">
<div class="container-registro mt-5">

    <div>
        <p class="titulo">SEF > Lista de practicas > Registrar datos de practica</p>
    </div>
    

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <form method="post" action="{{route('examenStorage')}}">

        @csrf
        <div class="form-group form-registro">
            <input type="hidden" value="{{$profesorId}}" name="profesor_id" id="profesorId">
        </div>
        
        <div class="form-group form-registro">
            <label>Titulo</label>
            <input type="text" class="form-control $errors->has('titulo') ? 'error' : '' " name="titulo">
            @if ($errors->has('titulo'))
            <div class="error">
                {{$errors->first('titulo')}}
            </div>
            @endif
        </div>

        <div class="form-group form-registro">
            <label>Numero de preguntas</label>
            <input type="number" class="form-control  $errors->has('numeroPreguntas') ? 'error' : '' " name="numeroPreguntas" id="numeroPreguntas">
            @if ($errors->has('numeroPreguntas'))
            <div class="error">
                {{$errors->first('numeroPreguntas')}}
            </div>
            @endif
        </div>

        <div class="div-btn-submit">
            <input type="submit" name="send" value="Registrar ➕" class="btn-opcion btn-opcion-color">
        </div>
    </form>
</div>

@endsection