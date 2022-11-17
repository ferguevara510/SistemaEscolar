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
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="container-registro mt-5">

    <form method="post" action="{{route('examenEdit', $examen->id)}}">
        @method('PUT')
        @csrf

        <div class="form-group form-registro">
            <input type="hidden" value="{{$examen->profesor_id}}" name="profesor_id" id="profesorId">
        </div>

        <div class="form-group form-registro">
            <label>Titulo</label>
            <input value="{{$examen->titulo}}" type="text" class="form-control  $errors->has('titulo') ? 'error' : '' " name="titulo">
            @if ($errors->has('titulo'))
            <div class="error">
                {{$errors->first('titulo')}}
            </div>
            @endif
        </div>

        <div class="form-group form-registro">
            <label>Numero preguntas</label>
            <input value="{{$examen->numeroPreguntas}}" type="number" class="form-control  $errors->has('numeroPreguntas') ? 'error' : '' " name="numeroPreguntas" id="numeroPreguntas">
            @if ($errors->has('numeroPreguntas'))
            <div class="error">
                {{$errors->first('numeroPreguntas')}}
            </div>
            @endif
        </div>

        <div class="div-btn-submit">
            <input type="submit" name="send" value="Modificar ✍️" class="btn-opcion btn-opcion-color">
        </div>
    </form>
    @if (count($preguntas) < $examen->numeroPreguntas)
        <div class="btn-registrar mt-5">
            <button type="button" class="btn-opcion"><a class="texto-link" href="{{ route('preguntaIndex', $examen->id ) }}">Agregar Pregunta ➕</a></button>
        </div>
    @endif
    
    <div class="contenedor-tarjetas">
    <table class="table tabla-consultar">
        <thead>
            <tr class="tabla-consultar">
                <th scope="col">Pregunta</th>
                <th scope="col">Modificar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($preguntas as $pregunta)
            <tr class="tabla-consultar">
                <td>{{$pregunta->descripcion}}</td>
                <td><button type="button" class="btn-opcion"><a class="texto-link" href="{{ route('preguntaShow', $pregunta->id) }}">Modificar ✍️</a></button></td>
                <td>
                    <form method="post" action="{{ route('preguntaDelete', $pregunta->id) }}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn-opcion btn-opcion-color"><a class="texto-link">Eliminar 🗑️</a></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection