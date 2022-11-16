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
    <p class="titulo">SEF > Lista de Examenes</p>
</div>

<div class="contenedor-tarjetas">
    <table class="table tabla-consultar">
        <thead>
            <tr class="tabla-consultar">
                <th scope="col">Examen</th>
                <th scope="col">calificacion</th>
                <th scope="col">Fecha de realizacion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($examenes as $examen)
            <tr class="tabla-consultar">
                <td>{{$examen->titulo}}</td>
                <td>{{$examen->pivot->calificacion}}</td>
                <td>{{$examen->pivot->fechaAplicacion}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection