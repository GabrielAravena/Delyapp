<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compras_historicas extends Model
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
        'inventario_id',
    ];
}
