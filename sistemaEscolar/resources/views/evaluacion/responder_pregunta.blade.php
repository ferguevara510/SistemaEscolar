@extends('layouts.footer')
@extends('layouts.menus.app_estudiante')
@section('content')
    <div>
        <p class="titulo">SEF > Examen</p>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $pregunta->descripcion }}</h5>
            @if (intval($total) == intval($index) + 1)
                <form action="{{ route('examenFinish') }}" method="POST">
            @else
                <form action="{{ route('respuestaExamen', $index) }}" method="POST">
            @endif
                @csrf
                @foreach ($pregunta->respuestas as $respuesta)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="respuesta_id" id="respuesta_id"
                            value="{{ $respuesta->id }}" />
                        <label class="form-check-label" for="respuesta_id">
                            {{ $respuesta->descripcion }}
                        </label>
                    </div>
                @endforeach
                
                @if (intval($total) == intval($index) + 1)
                    <div class="mt-5 div-btn-submit">
                        <input type="submit" name="send" value="Finalizar" class="btn-opcion btn-opcion-color">
                    </div>
                @else
                    <div class="mt-5 div-btn-submit">
                        <input type="submit" name="send" value="Siguiente" class="btn-opcion btn-opcion-color">
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection
