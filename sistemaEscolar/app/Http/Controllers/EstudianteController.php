<?php

namespace App\Http\Controllers;

use App\Enums\AreaAcademica;
use App\Enums\Entidad;
use App\Enums\Licenciatura;
use App\Enums\Region;
use App\Models\Estudiante;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function __construct (){
        // $this->middleware('auth');
    }

    public function vistaRegistrarEstudiante (){
        $enumLicenciatura = Licenciatura::getValues();
        $enumEntidad = Entidad::getValues();
        $enumAreaAcademica = AreaAcademica::getValues();
        $enumRegion = Region::getValues();
        return view('estudiante.registrar_estudiante', compact('enumLicencitura','enumEntidad','enumAreaAcademica','enumRegion'));
    }

    public function registrarEstudiante (Request $request){
        $nuevoEstudiante = $request->validate([
            'licenciatura' => ['required', new EnumValue(Licenciatura::class)],
            'entidad' => ['required', new EnumValue(Entidad::class)],
            'areaAcademica' => ['required', new EnumValue(AreaAcademica::class)],
            'region' => ['required', new EnumValue(Region::class)],
            'nombreEstudiante' => 'required',
            'apellidosEstudiante' => 'required',
            'matricula' => 'required',
            'correoInstitucional' => 'required',
            'contrasena' => 'required',
        ]);
        Estudiante::create($nuevoEstudiante);
        return back()->with('success','Estudiante creado');
    }

    public function consultarListaEstudiante (Request $request){
        $estudiante = [];
        $busqueda = $request->input('busqueda');
        if ($busqueda){
            $estudiante = Estudiante::query()->where('nombreEstudiante', 'LIKE', "%{$busqueda}%")->get();
        }
        else {
            $estudiante = Estudiante::all();
        }
        return view('estudiante.consultar_estudiante', compact('estudiante'));
    }

    public function modificarEstudiante (Request $request, $estudiante){
        $request->validate([
            'licenciatura' => ['required', new EnumValue(Licenciatura::class)],
            'entidad' => ['required', new EnumValue(Entidad::class)],
            'areaAcademica' => ['required', new EnumValue(AreaAcademica::class)],
            'region' => ['required', new EnumValue(Region::class)],
        ]);
        $estudiante= Estudiante::find($estudiante);
        $estudiante->licenciatura = $request->get('licenciatura');
        $estudiante->entidad = $request->get('entidad');
        $estudiante->areaAcademica = $request->get('areaAcademica');
        $estudiante->region = $request->get('region');
        $estudiante->update();
        return redirect('/consultarEstudiante')->with('success','Estudiante modificado');
    }

    public function mostrarEstudiante (Estudiante $estudiante){
        $enumLicenciatura = Licenciatura::getValues();
        $enumEntidad = Entidad::getValues();
        $enumAreaAcademica = AreaAcademica::getValues();
        $enumRegion = Region::getValues();
        return view('estudiante.modificar_estudiante', compact('estudiante','enumLicencitura','enumEntidad','enumAreaAcademica','enumRegion'));
    }

    public function eliminarEstudiante (Estudiante $estudiante){
        $estudiante->delete();
        return redirect('/consultarEstudiante')->with('success','Estudiante eliminado');
    }
}