<?php

namespace App\Http\Controllers;

use App\Enums\TipoUsuario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SesionController extends Controller
{
    public function iniciarSesion(Request $request){
        $sesion = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:8|max:60'
        ]);

        $user = User::query()->where('email', "=", $sesion['email'])->first();
        if($user && Hash::check($sesion['password'],$user->password)){
            switch ($user->tipoUsuario){
                case TipoUsuario::Admin:
                    Auth::guard('admin')->login($user);
                    return redirect()->route('home');
                    break;
                case TipoUsuario::Estudiante:
                    Auth::guard('estudiante')->login($user);
                    return redirect()->route('homeEstudiante');
                    break;
                case TipoUsuario::Profesor:
                    Auth::guard('profesor')->login($user);
                    return redirect()->route('homeProfesor');
                    break;
                default:
                    return redirect()->route('login')->with('message','El usuario no es valido');
                    break;
            }
        }else{
            return redirect()->route('login')->with('message','Error en la contraseña o el usuario');
        }
        
    }
}
