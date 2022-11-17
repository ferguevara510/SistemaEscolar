@extends('layouts.footer')
@extends('layouts.menus.app_profesor')
@section('content')

<link href="{{ asset('/css/registro.css') }}" rel="stylesheet">
<link href="{{ asset('/css/consultar.css') }}" rel="stylesheet">

<div>
    <p class="titulo">SEF > Lista de Examenes > Modificar datos Examenes</p>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
        <div class="div-btn-submit">
            <button type="button" class="btn-opcion"><a class="texto-link" href="{{ route('examenShow', $pregunta->examen_id) }}">Preguntas 🗒️</a></button>
        </div>
    </div>
@endif
<div class="container-registro mt-5">

    <form method="post" action="{{route('preguntaEdit', $pregunta->id)}}">
        @method('PUT')
        @csrf

        <div class="form-group form-registro">
            <input type="hidden" value="{{$pregunta->examen_id}}" name="examen_id" id="examenId">
        </div>

        <div class="form-group form-registro">
            <label>Descripcion</label>
            <input value="{{$pregunta->descripcion}}" type="text" class="form-control  $errors->has('descripcion') ? 'error' : '' " name="descripcion" id="descripcion">
            @if ($errors->has('descripcion'))
            <div class="error">
                {{$errors->first('descripcion')}}
            </div>
            @endif
        </div>

        <div class="div-btn-submit">
            <input type="submit" name="send" value="Modificar ✍️" class="btn-opcion btn-opcion-color">
        </div>
    </form>
    
    <div class="contenedor-tarjetas">
        <table class="table tabla-consultar">
            <thead>
                <tr class="tabla-consultar">
                    <th scope="col">cheched</th>
                    <th scope="col">Respuesta</th>
                    <th scope="col">Eliminar</th>
                    <th scope="col">Marcar como correcta</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($respuestas as $respuesta)
                <tr class="tabla-consultar">
                    <td><input type="checkbox" onclick="return false;" {{$respuesta->esCorrecto ? 'checked': ''}}/></td>
                    <td>{{$respuesta->descripcion}}</td>
                    <td>
                        <form method="post" action="{{ route('respuestaDelete', $respuesta->id) }}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn-opcion btn-opcion-color"><a class="texto-link">Eliminar 🗑️</a></button>
                        </form>
                    </td>
                    <td>
                        <form method="post" action="{{ route('respuestaCorrecta', $respuesta->id) }}">
                            @method('PUT')
                            @csrf
                            <button type="submit" class="btn-opcion btn-opcion-color"><a class="texto-link">Marcar ✔</a></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if (count($respuestas) < 4)
        <div class="container-registro mt-5">

            <form method="post" action="{{route('respuestaStorage')}}">

                @csrf
                <div class="form-group form-registro">
                    <input type="hidden" value="{{$pregunta->id}}" name="pregunta_id" id="preguntaId">
                </div>
                
                <div class="form-group form-registro">
                    <label>Respuesta</label>
                    <input type="text" class="form-control $errors->has('descripcion') ? 'error' : '' " name="descripcion">
                    @if ($errors->has('descripcion'))
                    <div class="error">
                        {{$errors->first('descripcion')}}
                    </div>
                    @endif
                </div>

                <div class="div-btn-submit">
                    <input type="submit" name="send" value="Registrar Respuesta ➕" class="btn-opcion btn-opcion-color">
                </div>
            </form>
        </div>
    @endif
    
</div>
@endsection