@extends('layouts.footer')
@extends('layouts.menus.app_profesor')
@section('content')

<link href="{{ asset('/css/consultar.css') }}" rel="stylesheet">

<div>
    <p class="titulo">SEF > Lista de Examenes</p>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
<div class="line-search">
    <section>
        <form method="get" action="{{ route('estudianteList') }}">		    
            <input class="line-search-input" type="search" name="busqueda" placeholder="Nombre estudiante">		    	
            <button class="btn-opcion-buscar" type="submit"><a class="texto-link">Buscar 🔍</a></button>
        </form>
    </section>
</div>
<div class="btn-registrar">
    <button type="button" class="btn-opcion"><a class="texto-link" href="{{ route('examenIndex') }}">Registrar ➕</a></button>
</div>
<div class="contenedor-tarjetas">
    <table class="table tabla-consultar">
        <thead>
            <tr class="tabla-consultar">
                <th scope="col">Examen</th>
                <th scope="col">Preguntas</th>
                <th scope="col">Resultados</th>
                <th scope="col">Modificar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($examenes as $examen)
            <tr class="tabla-consultar">
                <td>{{$examen->titulo}}</td>
                <td>{{$examen->numeroPreguntas}}</td>
                <td><button type="button" class="btn-opcion"><a class="texto-link" href="{{ route('examenResultados', $examen->id) }}">Resultados ✍️</a></button></td>
                <td><button type="button" class="btn-opcion"><a class="texto-link" href="{{ route('examenShow', $examen->id) }}">Modificar ✍️</a></button></td>
                <td>
                    <form method="post" action="{{ route('examenDelete', $examen->id) }}">
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
@endsection