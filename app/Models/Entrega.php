<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrega extends Model {
    protected $fillable = ['tarea_id', 'usuario_id', 'archivo_pdf'];
    public function tarea() { return $this->belongsTo(Tarea::class); }
    public function usuario() { return $this->belongsTo(User::class); }
}
