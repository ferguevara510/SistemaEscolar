@extends('layouts.footer')
@extends('layouts.menus.app_profesor')
@section('content')

<link href="{{ asset('/css/consultar.css') }}" rel="stylesheet">

<div>
    <p class="titulo">SEF > Lista de Estudiantes</p>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
<div class="line-search">
    <section>
        <form method="get" action="{{ route('estudianteProfList') }}">		    
            <input class="line-search-input" type="search" name="busqueda" placeholder="Nombre estudiante">		    	
            <button class="btn-opcion-buscar" type="submit">Buscar</button>
        </form>
    </section>
</div>
<div class="btn-registrar">
    <button type="button" id="registrarEstudiante" class="btn-opcion"><a class="texto-link" href="{{ route('estudianteProfIndex') }}">Registrar</a></button>
</div>
<div class="contenedor-tarjetas">
    <table class="table tabla-consultar">
        <thead>
            <tr class="tabla-consultar">
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Matricula</th>
                <th scope="col">Correo Institucional</th>
                <th scope="col">Licenciatura</th>
                <th scope="col">Entidad</th>
                <th scope="col">Area Academica</th>
                <th scope="col">Region</th>
                <th scope="col">Modificar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($estudiantes as $estudiante)
            <tr class="tabla-consultar">
                <td>{{$estudiante->nombreEstudiante}}</td>
                <td>{{$estudiante->apellidosEstudiante}}</td>
                <td>{{$estudiante->matricula}}</td>
                <td>{{$estudiante->correoInstitucional}}</td>
                <td>{{$estudiante->licenciatura}}</td>
                <td>{{$estudiante->entidad}}</td>
                <td>{{$estudiante->areaAcademica}}</td>
                <td>{{$estudiante->region}}</td>
                <td><button type="button" id="modificarEstudiante" class="btn-opcion"><a class="texto-link" href="{{ route('estudianteProfShow', $estudiante->id) }}">Modificar</a></button></td>
                <td>
                    <form method="post" action="{{ route('estudianteProfDelete', $estudiante->id) }}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" id="eliminarEstudiante" class="btn-opcion btn-opcion-color">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection