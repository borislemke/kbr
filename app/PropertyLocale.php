<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyLocale extends Model
{
    //
    public function property()
    {
        $this->belongsTo('App\Property');
    }
}
