@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEF</title>
    <link rel="preload" href="css/normalize.css" as="style">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet"> 
    <link rel="preload" href="{{ asset('css/colores.css') }}" as="style">
    <link rel="stylesheet" href="{{ asset('css/colores.css') }}">
    <link rel="preload" href="{{ asset('css/index.css') }}" as="style">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">>
    <link rel="preload" href="{{ asset('css/footer.css') }}" as="style">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">>
    <link rel="preload" href="js/index.js" as="script">
</head>

<main>
    <section id="informacion">
        <div class="contenedor">
            <div class="descripcion h1-color">
                <h1>Universidad Veracruzana</h1>
            </div>
        </div>
    </section>
</main>

<footer>
    <div class="leyenda">
        <p>Todos los derechos reservados a Universidad Veracruzana</p>
    </div>
</footer>
    <script src="js/index.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule="" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.js"></script>
@endsection
