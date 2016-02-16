<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    //

    public function property()
    {
        return $this->where('name', 'property')->belongsTo('App\Property', 'object_id');
    }
    
}
