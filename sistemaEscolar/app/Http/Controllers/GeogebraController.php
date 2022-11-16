<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeogebraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:estudiante');
    }

    public function vistaGeogebra()
    {
        return view('geogebra.geogebra_estudiantes');
    }
}
