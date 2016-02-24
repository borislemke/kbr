<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    //

    public function postTerms()
    {
        $this->hasMany('App\PostTerm');
    }

    public function posts()
    {
        return $this->belongsToMany('App\Post', 'post_terms');
    }

    public function parent()
    {
        return $this->belongsTo('App\Term', 'parent_id');
    }

    public function childs()
    {
        return $this->hasMany('App\Term', 'parent_id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($term)
        {

        });

        static::updating(function($term)
        {

        });

        static::deleting(function($term)
        {
            if ($term->type == 'post_category') {
                // set to uncategorized
                $postTerms = \App\PostTerm::where('term_id', $term->id)
                    ->update(['term_id' => 6]);
            }


        });

        static::created(function($term)
        {

        });

        static::updated(function($term)
        {

        });

        static::deleted(function($term)
        {

        });

    }

}
