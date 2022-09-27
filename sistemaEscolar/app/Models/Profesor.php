<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;
    public $fillable=['nombreProfesor','apellidosProfesor','noPersonal','correoInstitucional','contrasena','licenciatura','entidad','areaAcademica','region'];
}
