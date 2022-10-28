@extends('layouts.footer')
@extends('layouts.menus.app_estudiante')
@section('content')

<link href="{{ asset('/css/consultar.css') }}" rel="stylesheet">

<div>
    <p class="titulo">SEF > Lista de Contenido</p>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
<div class="line-search">
    <section>
        <form method="get" action="{{ route('materialList') }}">		    
            <input class="line-search-input" type="search" name="busqueda" placeholder="Titulo de material">		    	
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
            @foreach ($materials as $material)
            <tr class="tabla-consultar">
                <td>{{$material->funcion}}</td>
                <td>{{$material->titulo}}</td>
                <td>{{$material->descripcion}}</td>
                <td class="tabla-consultar"></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection