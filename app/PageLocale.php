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

    public function slug($slug, $id) {

        $rows  = $this->whereRaw("slug REGEXP '^{$slug}([0-9]*)?$'");

        $count = $rows->count() + 1;

        $locale = $rows->lists('page_id')->toArray();

        return ($count > 1 && !in_array($id, $locale)) ? "{$slug}-{$count}" : $slug;
    }
}
