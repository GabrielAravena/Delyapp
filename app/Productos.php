<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nombre', 
        'precio', 
        'tiempo_preparacion',
        'descripcion',
        'estado',
        'imagen',
        'local_id',

    ];

    public function ingredientes()
    {
        return $this->hasMany('App\Ingredientes');
    }

    public function user()
    {
        return $this->belongsToMany('App\User')->using('App\Clientes_productos');
    }

}
