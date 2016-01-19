<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    protected $table = 'Cities';

    public function province()
    {
        return $this->belongsTo('App\Province');
    }
}
