@extends('layouts.footer')
@extends('layouts.menus.app_estudiante')
@section('content')

<link href="{{ asset('/css/geogebra.css') }}" rel="stylesheet">

<div>
    <p class="titulo">SEF > Herramienta de Graficación</p>
</div>

<div class="line-search seccion-calculadora" id="ggb-element">
    <section>
        <form method="get" action="{{ route('geogebra') }}"></form>
    </section>
</div>
<script src="https://www.geogebra.org/apps/deployggb.js"></script>
<script>  
    var ggbApp = new GGBApplet({"appName": "graphing", "width": 800, "height": 600, "showToolBar": true, "showAlgebraInput": true, "showMenuBar": true }, true);
      window.addEventListener("load", function() {  
        ggbApp.inject("ggb-element");
   });
</script>

@endsection