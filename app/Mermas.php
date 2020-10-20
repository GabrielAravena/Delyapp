<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mermas extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 
        'porcentaje',
    ];

    public $timestamps = false;
}
