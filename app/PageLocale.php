<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageLocale extends Model
{
    //
    public function page()
    {
        return $this->belongsTo('App\Page');
    }
}
