<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gastos_fijos extends Model
{
    protected $fillable = [
        'nombre', 
        'monto',
        'local_id',
    ];

    protected $table = 'gastos_fijos';
}
