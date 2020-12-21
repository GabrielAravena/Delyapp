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

    public static function eliminar(Productos $producto){

        $ingredientes = Ingredientes::where('producto_id', $producto->id);
        $ingredientes->delete();

        $productos_user = Productos_user::where('producto_id', $producto->id);
        $productos_user->delete();

        Productos::destroy($producto->id);
    }

}
