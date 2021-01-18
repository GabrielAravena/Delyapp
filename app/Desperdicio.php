<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desperdicio extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'local_id',
    ];

    public function detalles_desperdicios()
    {
        return $this->hasMany('App\Detalles_desperdicio');
    }
}
