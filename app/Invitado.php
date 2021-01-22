<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitado extends Model
{
    protected $fillable = [
        'id', 
        'nombre', 
        'email',
        'direccion', 
        'latitud',
        'longitud', 
        'telefono',
    ];
}
