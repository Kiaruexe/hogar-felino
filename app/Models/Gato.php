<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gato extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'edad',
        'sexo',
        'descripcion',
        'imagen',
        'casa_acogida_id',
        'raza',
        'color'
    ];

    public function casaAcogida()
    {
        return $this->belongsTo(Casa::class, 'casa_acogida_id');
    }

    public function getEdadEnAniosAttribute()
    {
        if (!$this->edad) {
            return null;
        }
        return Carbon::parse($this->edad)->age;
    }
}
