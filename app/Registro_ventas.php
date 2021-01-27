<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registro_ventas extends Model
{
    protected $fillable = [
        'local_id',
        'users_id',
        'invitado',
        'venta_id',
        'tipo',
        'valor',
        'delivery',
        'entregado',
    ];
}
