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

    public function slug($slug, $id) {

        $rows  = $this->whereRaw("slug REGEXP '^{$slug}([0-9]*)?$'");

        $count = $rows->count() + 1;

        $locale = $rows->lists('property_id')->toArray();

        return ($count > 1 && !in_array($id, $locale)) ? "{$slug}-{$count}" : $slug;
    }

}
