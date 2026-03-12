<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $fillable = ['nombre_grupo', 'horario_id'];

    public function horario() {
        return $this->belongsTo(Horario::class);
    }
}