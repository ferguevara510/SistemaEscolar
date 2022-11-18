@extends('layouts.footer')
@extends('layouts.menus.app_profesor')
@section('content')

<link href="{{ asset('/css/registro.css') }}" rel="stylesheet">

<div>
    <p class="titulo">SEF > Lista de contenidos > Modificar datos de contenido</p>
</div>

@if ($message = Session::get('error'))
    <div class="alert alert-danger no-mb">
        <p>{{ $message }}</p>
    </div>
@endif

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="container-registro mt-5">

    <form method="post" action="{{route('contenidoEdit', $contenido->id)}}" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <div class="form-group form-registro">
            <label>Titulo</label>
            <input value="{{ $contenido->titulo }}" type="text" class="form-control  $errors->has('titulo') ? 'error' : '' " name="titulo" id="titulo">
            @if ($errors->has('titulo'))
            <div class="error">
                {{$errors->first('titulo')}}
            </div>
            @endif
        </div>

        <div class="form-group form-registro">
            <label>Descripción</label>
            <input value="{{ $contenido->descripcion }}" type="text" class="form-control  $errors->has('descripcion') ? 'error' : '' " name="descripcion" id="descripcion">
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
                @if ($contenido->funcion === $funcion)
                <option selected value="{{$funcion}}">{{$funcion}}</option>
                @else
                <option value="{{$funcion}}">{{$funcion}}</option>
                @endif          
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
            <input value="{{ $contenido->archivo }}" type="file" class="form-control  {{$errors->has('archivo') ? 'error' : ''}} " name="archivo" id="archivo" accept="application/pdf">
            <a target="_blank" href="{{ asset('/archivo/'.$contenido->archivo) }}">{{$contenido->archivo}}</a>
            @if ($errors->has('archivo'))
            <div class="error">
                {{$errors->first('archivo')}}
            </div>
            @endif
        </div>

        <div class="div-btn-submit">
            <input type="submit" name="send" value="Modificar ✍️" class="btn-opcion btn-opcion-color">
        </div>
    </form>
</div>
@endsection