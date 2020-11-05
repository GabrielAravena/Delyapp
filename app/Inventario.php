<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
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
        'pmp',
        'ultimo_precio',
        'merma',
        'local_id',
    ];

    public function compras_historicas()
    {
        return $this->hasMany('App\Compras_historicas');
    }
}
