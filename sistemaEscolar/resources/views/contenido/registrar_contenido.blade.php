@extends('layouts.footer')
@extends('layouts.menus.app_profesor')
@section('content')

<link href="{{ asset('/css/registro.css') }}" rel="stylesheet">

<div>
    <p class="titulo">SEF > Lista de Contenido > Registrar datos Contenido</p>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
<div class="container-registro mt-5">

    <form method="post" action="{{route('contenidoIndex')}}" enctype="multipart/form-data">

        @csrf

        <div class="form-group form-registro">
            <label>Titulo</label>
            <input type="text" class="form-control  $errors->has('titulo') ? 'error' : '' " name="titulo" id="titulo">
            @if ($errors->has('titulo'))
            <div class="error">
                {{$errors->first('titulo')}}
            </div>
            @endif
        </div>

        <div class="form-group form-registro">
            <label>Descripción</label>
            <input type="text" class="form-control  $errors->has('descripcion') ? 'error' : '' " name="descripcion" id="descripcion">
            @if ($errors->has('descripcion'))
            <div class="error">
                {{$errors->first('descripcion')}}
            </div>
            @endif
        </div>

        <div class="form-group form-registro">
            <label>Funcion</label>
            <select class="form-control  $errors->has('funcion') ? 'error' : '' " name="funcion" id="funcion">
                @foreach ($enumFuncion as $funcion)
                <option value="{{$funcion}}">{{$funcion}}</option>
                @endforeach
            </select>
            @if ($errors->has('funcion'))
            <div class="error">
                {{$errors->first('funcion')}}
            </div>
            @endif
        </div>

        <div class="form-group form-registro">
            <label>Archivo</label>
            <input type="file" class="form-control  {{$errors->has('archivo') ? 'error' : ''}} " name="archivo" id="archivo" accept="application/pdf">
            @if ($errors->has('archivo'))
            <div class="error">
                {{$errors->first('archivo')}}
            </div>
            @endif
        </div>

        <div class="div-btn-submit">
            <input type="submit" name="send" value="Registrar ➕" class="btn-opcion btn-opcion-color">
        </div>
    </form>
</div>
@endsection