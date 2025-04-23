<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MensajeContacto extends Model
{
    protected $table = 'mensajes_contacto';

    protected $fillable = ['nombre', 'email', 'mensaje', 'gato_id'];

    public function gato()
    {
        return $this->belongsTo(Gato::class);
    }
}
