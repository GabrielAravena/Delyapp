<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_desperdicio extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'cantidad',
        'desperdicio',
        'unidad_medida',
        'valor_desperdiciado',
        'desperdicio_id',
    ];
}
