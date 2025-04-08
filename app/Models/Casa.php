<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Casa extends Authenticatable
{
    use HasFactory;

    protected $table = 'casas';

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'telefono',
        'descripcion',
        'fechaRegistro',
        'estadoCuenta',
        'rol'
    ];

    public function gatos()
    {
        return $this->hasMany(Gato::class, 'casa_acogida_id');
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
