@extends('layouts.footer')
@extends('layouts.menus.app_estudiante')
@section('content')

<link href="{{ asset('/css/consultar.css') }}" rel="stylesheet">

<div>
    <p class="titulo">SEF > Lista de contenidos</p>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
<div class="line-search">
    <section>
        <form method="get" action="{{ route('contenidoEstList') }}">		    
            <input class="line-search-input" type="search" name="busqueda" placeholder="Titulo de contenido">		    	
            <button class="btn-opcion-buscar" type="submit"><a class="texto-link">Buscar 🔍</a></button>
        </form>
    </section>
</div>
<div class="contenedor-tarjetas">
    <table class="table tabla-consultar">
        <thead>
            <tr class="tabla-consultar">
                <th scope="col">Funcion</th>
                <th scope="col">Titulo</th>
                <th scope="col">Descripción</th>
                <th scope="col">Archivo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contenidos as $contenido)
            <tr class="tabla-consultar">
                <td>{{$contenido->funcion}}</td>
                <td>{{$contenido->titulo}}</td>
                <td>{{$contenido->descripcion}}</td>
                <td><a target="_blank" href="{{ asset('/archivo/'.$contenido->archivo) }}">{{$contenido->archivo}}</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection