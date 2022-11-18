@extends('layouts.footer')
@extends('layouts.menus.app_estudiante')
@section('content')

<link href="{{ asset('/css/consultar.css') }}" rel="stylesheet">

@if ($message = Session::get('error'))
    <div class="alert alert-danger no-mb">
        <p>{{ $message }}</p>
    </div>
@endif

<div>
    <p class="titulo">SEF > Lista de practicas</p>
</div>

<div class="contenedor-tarjetas">
    <table class="table tabla-consultar">
        <thead>
            <tr class="tabla-consultar">
                <th scope="col">Practica</th>
                <th scope="col">Numero de preguntas</th>
                <th scope="col">Realizar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($examenes as $examen)
            <tr class="tabla-consultar">
                <td>{{$examen->titulo}}</td>
                <td>{{$examen->numeroPreguntas}}</td>
                <td>
                    <form method="post" action="{{ route('examenStart', $examen->id) }}">
                        @csrf
                        <button type="submit" class="btn-opcion btn-opcion-color"><a class="texto-link">Iniciar ✍️</a></button>
                    </form>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection