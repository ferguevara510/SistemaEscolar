@extends('layouts.footer')
@extends('layouts.menus.app_profesor')
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
<div class="btn-registrar">
    <button type="button" id="registrarMaterial" class="btn-opcion"><a class="texto-link" href="{{ route('materialIndex') }}">Registrar ➕</a></button>
</div>
<div class="contenedor-tarjetas">
    <table class="table tabla-consultar">
        <thead>
            <tr class="tabla-consultar">
                <th scope="col">Funcion</th>
                <th scope="col">Titulo</th>
                <th scope="col">Descripción</th>
                <th scope="col">Archivo</th>
                <th scope="col">Modificar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($materials as $material)
            <tr class="tabla-consultar">
                <td>{{$material->funcion}}</td>
                <td>{{$material->titulo}}</td>
                <td>{{$material->descripcion}}</td>
                <td class="tabla-consultar"></td>
                <td><button type="button" id="modificarMaterial" class="btn-opcion"><a class="texto-link" href="{{ route('materialShow', $material->id) }}">Modificar ✍️</a></button></td>
                <td>
                    <form method="post" action="{{ route('materialDelete', $material->id) }}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" id="eliminarMaterial" class="btn-opcion btn-opcion-color"><a class="texto-link">Eliminar 🗑️</a></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection