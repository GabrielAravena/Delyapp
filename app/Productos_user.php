<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\map;

class Productos_user extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'producto_id',
        'inventario_id',
        'cantidad',
        'users_id',
        'ventas_id',
        'invitado',

    ];

}
