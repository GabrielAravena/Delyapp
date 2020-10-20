<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'estado', 
        'fecha', 
        'tipo',
        'precio',
    ];

    public function clientes_productos()
    {
        return $this->hasMany('App\Clientes_productos');
    }
}
