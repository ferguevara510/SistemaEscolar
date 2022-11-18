@extends('layouts.footer')
@extends('layouts.menus.app')
@section('content')
    <link href="{{ asset('/css/registro.css') }}" rel="stylesheet">

    <div>
        <p class="titulo">SEF > Lista de profesores > Modificar contraseña de profesor</p>
    </div>

    @if ($message = Session::get('error'))
        <div class="alert alert-danger no-mb">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="container-registro mt-5">

        <form method="post" action="{{ route('profesorCambiarContrasena', $profesor->id) }}">
            @method('PUT')
            @csrf

            <div class="form-group form-registro">
                <label>Nueva contraseña</label>
                <input type="password"
                    class="form-control  {{$errors->has('contrasena') ? 'error' : ''}} " name="contrasena"
                    id="nombreEstudiante">
                @if ($errors->has('contrasena'))
                    <div class="error">
                        {{ $errors->first('contrasena') }}
                    </div>
                @endif
            </div>

            <div class="div-btn-submit">
                <input type="submit" name="send" value="Modificar ✍️" class="btn-opcion btn-opcion-color">
            </div>
        </form>
    </div>
@endsection
