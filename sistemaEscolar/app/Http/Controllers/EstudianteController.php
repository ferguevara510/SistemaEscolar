<?php

namespace App\Http\Controllers;

use App\Enums\AreaAcademica;
use App\Enums\Entidad;
use App\Enums\Licenciatura;
use App\Enums\Region;
use App\Enums\TipoUsuario;
use App\Models\Estudiante;
use App\Models\User;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EstudianteController extends Controller
{
    public function __construct (){
        $this->middleware('auth');
    }

    public function vistaRegistrarEstudiante (){
        $enumLicenciatura = Licenciatura::getValues();
        $enumEntidad = Entidad::getValues();
        $enumAreaAcademica = AreaAcademica::getValues();
        $enumRegion = Region::getValues();
        return view('estudiante.registrar_estudiante',compact('enumLicenciatura','enumEntidad','enumAreaAcademica','enumRegion'));
    }

    public function vistaRegistrarEstudianteProfesor (){
        $enumLicenciatura = Licenciatura::getValues();
        $enumEntidad = Entidad::getValues();
        $enumAreaAcademica = AreaAcademica::getValues();
        $enumRegion = Region::getValues();
        return view('estudiante.registrar_estudiante_profesor',compact('enumLicenciatura','enumEntidad','enumAreaAcademica','enumRegion'));
    }

    public function registrarEstudiante (Request $request){
        $nuevoEstudiante = $request->validate([
            'licenciatura' => ['required', new EnumValue(Licenciatura::class)],
            'entidad' => ['required', new EnumValue(Entidad::class)],
            'areaAcademica' => ['required', new EnumValue(AreaAcademica::class)],
            'region' => ['required', new EnumValue(Region::class)],
            'nombreEstudiante' => 'required',
            'apellidosEstudiante' => 'required',
            'matricula' => ['required', 'unique:estudiantes'],
            'correoInstitucional' => ['required', 'email', 'unique:estudiantes'],
            'contrasena' => 'required',
        ]);
        $usuarioExistente = User::query()->where('email','=',$nuevoEstudiante['correoInstitucional'])->first();
        if($usuarioExistente){
            return back()->with('error','El correo ya esta ocupado');
        }
        $newUser = [
            'name' => $nuevoEstudiante['nombreEstudiante'],
            'email' => $nuevoEstudiante['correoInstitucional'],
            'password' => Hash::make($nuevoEstudiante['contrasena']),
            'tipoUsuario' => TipoUsuario::Estudiante,
        ];
        $user = User::create($newUser);
        $nuevoEstudiante['user_id'] = $user->id;
        Estudiante::create($nuevoEstudiante);
        return back()->with('success','Estudiante creado');
    }

    public function registrarEstudianteProfesor (Request $request){
        $nuevoEstudiante = $request->validate([
            'licenciatura' => ['required', new EnumValue(Licenciatura::class)],
            'entidad' => ['required', new EnumValue(Entidad::class)],
            'areaAcademica' => ['required', new EnumValue(AreaAcademica::class)],
            'region' => ['required', new EnumValue(Region::class)],
            'nombreEstudiante' => 'required',
            'apellidosEstudiante' => 'required',
            'matricula' => ['required', 'unique:estudiantes'],
            'correoInstitucional' => ['required', 'email', 'unique:estudiantes'],
            'contrasena' => 'required',
        ]);
        $usuarioExistente = User::query()->where('email','=',$nuevoEstudiante['correoInstitucional'])->first();
        if($usuarioExistente){
            return back()->with('error','El correo ya esta ocupado');
        }
        $newUser = [
            'name' => $nuevoEstudiante['nombreEstudiante'],
            'email' => $nuevoEstudiante['correoInstitucional'],
            'password' => Hash::make($nuevoEstudiante['contrasena']),
            'tipoUsuario' => TipoUsuario::Estudiante,
        ];
        $user = User::create($newUser);
        $nuevoEstudiante['user_id'] = $user->id;
        Estudiante::create($nuevoEstudiante);
        return back()->with('success','Estudiante creado');
    }

    public function consultarListaEstudiantes (Request $request){
        $estudiantes = [];
        $busqueda = $request->input('busqueda');
        if ($busqueda){
            $estudiantes = Estudiante::query()->where('nombreEstudiante', 'LIKE', "%{$busqueda}%")->get();
        }
        else {
            $estudiantes = Estudiante::all();
        }
        return view('estudiante.consultar_estudiante',compact('estudiantes'));
    }

    public function consultarListaEstudiantesProfesor (Request $request){
        $estudiantes = [];
        $busqueda = $request->input('busqueda');
        if ($busqueda){
            $estudiantes = Estudiante::query()->where('nombreEstudiante', 'LIKE', "%{$busqueda}%")->get();
        }
        else {
            $estudiantes = Estudiante::all();
        }
        return view('estudiante.consultar_estudiante_profesor',compact('estudiantes'));
    }

    public function modificarEstudiante (Request $request, $estudiante){
        $request->validate([
            'nombreEstudiante' => 'required',
            'apellidosEstudiante' => 'required',
            'matricula' => ['required'],
            'correoInstitucional' => ['required', 'email'],
            'licenciatura' => ['required', new EnumValue(Licenciatura::class)],
            'entidad' => ['required', new EnumValue(Entidad::class)],
            'areaAcademica' => ['required', new EnumValue(AreaAcademica::class)],
            'region' => ['required', new EnumValue(Region::class)],
        ]);
        $estudiante= Estudiante::find($estudiante);
        $usuarioExistente = User::query()->where('email','=',$request->get('correoInstitucional'))->where('id', '!=', $estudiante->user_id)->first();
        if($usuarioExistente){
            return back()->with('error','El correo ya esta ocupado');
        }

        $estudianteExiste = Estudiante::query()->where('matricula','=',$request->get('matricula'))->where('id', '!=', $estudiante->id)->first();

        if($estudianteExiste){
            return back()->with('error', 'La matricula esta ocupada');
        }

        $usuario = User::find($estudiante->user_id);
        $usuario->name = $request->get('nombreEstudiante');
        $usuario->email = $request->get('correoInstitucional');
        $estudiante->nombreEstudiante = $request->get('nombreEstudiante');
        $estudiante->apellidosEstudiante = $request->get('apellidosEstudiante');
        $estudiante->matricula = $request->get('matricula');
        $estudiante->correoInstitucional = $request->get('correoInstitucional');
        $estudiante->licenciatura = $request->get('licenciatura');
        $estudiante->entidad = $request->get('entidad');
        $estudiante->areaAcademica = $request->get('areaAcademica');
        $estudiante->region = $request->get('region');
        $estudiante->update();
        return redirect('/consultarEstudiante')->with('success',"Estudiante modificado {$estudiante->nombreEstudiante}, {$estudiante->apellidosEstudiante}, {$estudiante->matricula}, {$estudiante->correoInstitucional}, {$estudiante->licenciatura}, {$estudiante->entidad}, {$estudiante->areaAcademica}, {$estudiante->region}");
    }

    public function modificarEstudianteProfesor (Request $request, $estudiante){
        $request->validate([
            'nombreEstudiante' => 'required',
            'apellidosEstudiante' => 'required',
            'matricula' => ['required',],
            'correoInstitucional' => ['required', 'email'],
            'licenciatura' => ['required', new EnumValue(Licenciatura::class)],
            'entidad' => ['required', new EnumValue(Entidad::class)],
            'areaAcademica' => ['required', new EnumValue(AreaAcademica::class)],
            'region' => ['required', new EnumValue(Region::class)],
        ]);
        $estudiante= Estudiante::find($estudiante);
        $usuarioExistente = User::query()->where('email','=',$request->get('correoInstitucional'))->where('id', '!=', $estudiante->user_id)->first();
        if($usuarioExistente){
            return back()->with('error','El correo ya esta ocupado');
        }

        $estudianteExiste = Estudiante::query()->where('matricula','=',$request->get('matricula'))->where('id', '!=', $estudiante->id)->first();

        if($estudianteExiste){
            return back()->with('error', 'La matricula esta ocupada');
        }
        $usuario = User::find($estudiante->user_id);
        $usuario->name = $request->get('nombreEstudiante');
        $usuario->email = $request->get('correoInstitucional');
        $estudiante->nombreEstudiante = $request->get('nombreEstudiante');
        $estudiante->apellidosEstudiante = $request->get('apellidosEstudiante');
        $estudiante->matricula = $request->get('matricula');
        $estudiante->correoInstitucional = $request->get('correoInstitucional');
        $estudiante->licenciatura = $request->get('licenciatura');
        $estudiante->entidad = $request->get('entidad');
        $estudiante->areaAcademica = $request->get('areaAcademica');
        $estudiante->region = $request->get('region');
        $estudiante->update();
        return redirect('/consultarEstudianteProfesor')->with('success',"Estudiante modificado {$estudiante->nombreEstudiante}, {$estudiante->apellidosEstudiante}, {$estudiante->matricula}, {$estudiante->correoInstitucional}, {$estudiante->licenciatura}, {$estudiante->entidad}, {$estudiante->areaAcademica}, {$estudiante->region}");
    }

    public function mostrarEstudiante (Estudiante $estudiante){
        $enumLicenciatura = Licenciatura::getValues();
        $enumEntidad = Entidad::getValues();
        $enumAreaAcademica = AreaAcademica::getValues();
        $enumRegion = Region::getValues();
        return view('estudiante.modificar_estudiante',compact('estudiante','enumLicenciatura','enumEntidad','enumAreaAcademica','enumRegion'));
    }

    public function mostrarEstudianteProfesor (Estudiante $estudiante){
        $enumLicenciatura = Licenciatura::getValues();
        $enumEntidad = Entidad::getValues();
        $enumAreaAcademica = AreaAcademica::getValues();
        $enumRegion = Region::getValues();
        return view('estudiante.modificar_estudiante_profesor',compact('estudiante','enumLicenciatura','enumEntidad','enumAreaAcademica','enumRegion'));
    }

    public function cambiarContraseña(Request $request, Estudiante $estudiante){
        $request->validate([
            'contrasena' => ['required'],
        ]);
        $contraseña = Hash::make($request->get('contrasena'));
        $user = User::find($estudiante->user_id);
        $user->password = $contraseña;
        $user->update();
        $estudiante->contrasena = $contraseña;
        $estudiante->update();
        return redirect()->route('estudianteList')->with('success',"Contraseña modificada {$estudiante->nombreEstudiante}, {$estudiante->apellidosEstudiante}, {$estudiante->matricula}, {$estudiante->correoInstitucional}");
    }

    public function cambiarContraseñaEstudianteProfesor(Request $request, Estudiante $estudiante){
        $request->validate([
            'contrasena' => ['required'],
        ]);
        $contraseña = Hash::make($request->get('contrasena'));
        $user = User::find($estudiante->user_id);
        $user->password = $contraseña;
        $user->update();
        $estudiante->contrasena = $contraseña;
        $estudiante->update();
        return redirect()->route('estudianteProfList')->with('success',"Contraseña modificada {$estudiante->nombreEstudiante}, {$estudiante->apellidosEstudiante}, {$estudiante->matricula}, {$estudiante->correoInstitucional}");

    }

    public function vistaCambioContraseña(Request $request, Estudiante $estudiante){
        return view('estudiante.cambiar_contraseña', compact('estudiante'));
    }

    public function vistaEstudianteProfesorCambioContraseña(Request $request, Estudiante $estudiante){
        return view('estudiante.cambiar_contraseña_estudiante', compact('estudiante'));
    }

    public function eliminarEstudiante (Estudiante $estudiante){
        $estudiante->delete();
        return redirect('/consultarEstudiante')->with('success',"Estudiante eliminado {$estudiante->nombreEstudiante}, {$estudiante->apellidosEstudiante}, {$estudiante->matricula}, {$estudiante->correoInstitucional}, {$estudiante->licenciatura}, {$estudiante->entidad}, {$estudiante->areaAcademica}, {$estudiante->region}");
    }

    public function eliminarEstudianteProfesor (Estudiante $estudiante){
        $estudiante->delete();
        return redirect('/consultarEstudianteProfesor')->with('success',"Estudiante eliminado {$estudiante->nombreEstudiante}, {$estudiante->apellidosEstudiante}, {$estudiante->matricula}, {$estudiante->correoInstitucional}, {$estudiante->licenciatura}, {$estudiante->entidad}, {$estudiante->areaAcademica}, {$estudiante->region}");
    }
}