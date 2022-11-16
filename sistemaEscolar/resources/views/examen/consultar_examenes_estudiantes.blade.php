@extends('layouts.footer')
@extends('layouts.menus.app_profesor')
@section('content')

<link href="{{ asset('/css/consultar.css') }}" rel="stylesheet">

@if ($message = Session::get('error'))
    <div class="alert alert-danger">
        <p>{{ $message }}</p>
    </div>
@endif

<div>
    <p class="titulo">SEF > Lista de Examenes > {{$examen->titulo}}</p>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="contenedor-tarjetas">
    <table class="table tabla-consultar">
        <thead>
            <tr class="tabla-consultar">
                <th scope="col">Estudiante</th>
                <th scope="col">Calificación</th>
                <th scope="col">Fecha de realizado</th>
                <th scope="col">Habilitar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($examen->estudiantes as $estudiante)
            <tr class="tabla-consultar">
                <td>{{$estudiante->nombreEstudiante}} {{$estudiante->apellidosEstudiante}}</td>
                <td>{{$estudiante->pivot->calificacion}}</td>
                <td>{{$estudiante->pivot->fechaAplicacion}}</td>
                <td>
                    <form method="post" action="{{ route('examenHabilitar', [$examen->id, $estudiante->id]) }}">
                        @csrf
                        <button type="submit" class="btn-opcion btn-opcion-color"><a class="texto-link">Habilitar</a></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection