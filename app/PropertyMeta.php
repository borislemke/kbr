<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyMeta extends Model
{
    //
    public function property()
    {
        $this->belongsTo('App\Property');
    }
}
