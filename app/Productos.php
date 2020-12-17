<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

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
        'precio_sugerido',
        'tiempo_preparacion',
        'descripcion',
        'estado',
        'imagen',
        'categoria',
        'local_id',
    ];

    public function ingredientes()
    {
        return $this->hasMany('App\Ingredientes');
    }

    public function user()
    {
        return $this->belongsToMany('App\User')->using('App\Productos_user');
    }

}
