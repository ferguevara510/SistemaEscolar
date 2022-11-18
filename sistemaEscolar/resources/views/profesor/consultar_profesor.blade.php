@extends('layouts.footer')
@extends('layouts.menus.app')
@section('content')

<link href="{{ asset('/css/consultar.css') }}" rel="stylesheet">

<div>
    <p class="titulo">SEF > Lista de profesores</p>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
<div class="line-search">
    <section>
        <form method="get" action="{{ route('profesorList') }}">		    
            <input class="line-search-input" type="search" name="busqueda" placeholder="Nombre profesor">		    	
            <button class="btn-opcion-buscar" type="submit"><a class="texto-link">Buscar 🔍</a></button>
        </form>
    </section>
</div>
<div class="btn-registrar">
    <button type="button" id="registrarProfesor" class="btn-opcion"><a class="texto-link" href="{{ route('profesorIndex') }}">Registrar ➕</a></button>
</div>
<div class="contenedor-tarjetas">
    <table class="table tabla-consultar">
        <thead>
            <tr class="tabla-consultar">
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">No. Personal</th>
                <th scope="col">Correo Institucional</th>
                <th scope="col">Licenciatura</th>
                <th scope="col">Entidad</th>
                <th scope="col">Area Academica</th>
                <th scope="col">Region</th>
                <th scope="col">Cambiar Contraseña</th>
                <th scope="col">Modificar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($profesors as $profesor)
            <tr class="tabla-consultar">
                <td>{{$profesor->nombreProfesor}}</td>
                <td>{{$profesor->apellidosProfesor}}</td>
                <td>{{$profesor->noPersonal}}</td>
                <td>{{$profesor->correoInstitucional}}</td>
                <td>{{$profesor->licenciatura}}</td>
                <td>{{$profesor->entidad}}</td>
                <td>{{$profesor->areaAcademica}}</td>
                <td>{{$profesor->region}}</td>
                <td><button type="button" id="modificarProfesor" class="btn-opcion"><a class="texto-link" href="{{ route('profesorContrasena', $profesor->id) }}">Cambiar contraseña ✍️</a></button></td>
                <td><button type="button" id="modificarProfesor" class="btn-opcion"><a class="texto-link" href="{{ route('profesorShow', $profesor->id) }}">Modificar ✍️</a></button></td>
                <td>
                    <form method="post" action="{{ route('profesorDelete', $profesor->id) }}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" id="eliminarProfesor" class="btn-opcion btn-opcion-color"><a class="texto-link">Eliminar 🗑️</a></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection