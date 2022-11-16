<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamenEstudiante extends Model
{
    use HasFactory;

    public function respuesta(){
        return $this->belongsTo('App\Models\Respuesta');
    }

    public $fillable=['pregunta_id','respuesta_id','examen_id','estudiante_id'];
}
