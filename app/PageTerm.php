<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageTerm extends Model
{
    //
    public function page()
    {
        return $this->belongsTo('App\Page');
    }

    public function term()
    {
        return $this->belongsTo('App\Term');
    }
}
