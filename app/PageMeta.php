<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageMeta extends Model
{
    //
    public function page()
    {
        return $this->belongsTo('App\Page');
    }
}
