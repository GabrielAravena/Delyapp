<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 
        'direccion', 
        'telefono',
        'imagen',
        'estado',
        'delivery',
    ];

    protected $table = 'local';

    public function productos()
    {
        return $this->hasMany('App\Productos');
    }

    public function inventario()
    {
        return $this->hasMany('App\Inventario');
    }

    public function gastos_fijos()
    {
        return $this->hasMany('App\Gastos_fijos');
    }

}
