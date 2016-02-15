<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyTerm extends Model
{
    //
    public function property()
    {
        $this->belongsTo('App\Property');
    }

    public function term()
    {
        $this->belongsTo('App\Term');
    }
}
