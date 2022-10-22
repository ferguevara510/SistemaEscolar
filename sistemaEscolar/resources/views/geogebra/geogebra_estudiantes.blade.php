@extends('layouts.footer')
@extends('layouts.app')

@section('content')
<link href="{{ asset('/css/geogebra.css') }}" rel="stylesheet">

<div>
    <p class="titulo">SEF > Herramienta de Graficación</p>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="line-search">
    <section>
        <form method="get" action="{{ route('geogebra') }}"></form>
    </section>
</div>
<div class="seccion-calculadora"><div id="ggb-element"></div></div>
<script src="https://www.geogebra.org/apps/deployggb.js"></script>
<script>  
    var ggbApp = new GGBApplet({"appName": "graphing", "width": 800, "height": 600, "showToolBar": true, "showAlgebraInput": true, "showMenuBar": true }, true);
      window.addEventListener("load", function() {  
        ggbApp.inject("ggb-element");
   });
</script>

@endsection