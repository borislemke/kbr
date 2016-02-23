<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostLocale extends Model
{
    //
    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function slug($slug, $id) {

        $rows  = $this->whereRaw("slug REGEXP '^{$slug}([0-9]*)?$'");

        $count = $rows->count() + 1;

        $locale = $rows->lists('post_id')->toArray();

        return ($count > 1 && !in_array($id, $locale)) ? "{$slug}-{$count}" : $slug;
    }

}
