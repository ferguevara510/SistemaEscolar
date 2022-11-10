<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;

    public function preguntas() {
        return $this->hasMany('App\Models\Pregunta');
    }

    public function estudiantes() {
        return $this->belongsToMany('App\Models\Estudiante', 'evaluacions')->withPivot('id','calificacion','fechaAplicacion', 'estudiante_id');
    }
    
    public $fillable=['titulo','numeroPreguntas','profesor_id'];
}
