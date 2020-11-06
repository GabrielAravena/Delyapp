<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredientes extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 
        'cantidad', 
        'unidad_medida',
        'valor',
        'merma',
        'producto_id',
        'inventario_id',
    ];

}
