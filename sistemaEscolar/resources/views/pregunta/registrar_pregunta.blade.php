@extends('layouts.footer')
@extends('layouts.menus.app_profesor')
@section('content')

<link href="{{ asset('/css/registro.css') }}" rel="stylesheet">
<div class="container-registro mt-5">

    <form method="post" action="{{route('preguntaStorage')}}">

        @csrf
        <div class="form-group form-registro">
            <input type="hidden" value="{{$examenId}}" name="examen_id" id="examenId">
        </div>
        
        <div class="form-group form-registro">
            <label>Pregunta</label>
            <input type="text" class="form-control $errors->has('descripcion') ? 'error' : '' " name="descripcion">
            @if ($errors->has('descripcion'))
            <div class="error">
                {{$errors->first('descripcion')}}
            </div>
            @endif
        </div>

        <div class="div-btn-submit">
            <input type="submit" name="send" value="Registrar ➕" class="btn-opcion btn-opcion-color">
        </div>
    </form>
</div>

@endsection