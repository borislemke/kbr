<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    public function terms()
    {
        return $this->belongsToMany('App\Term', 'post_terms');
    }

    public function categories()
    {
        return $this->terms()->where('type', 'post_category');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function postLocales()
    {
        return $this->hasMany('App\PostLocale');
    }

    public function postTerms()
    {
        return $this->hasMany('App\PostTerm');   
    }

    public function postMetas()
    {
        return $this->hasMany('App\PostMeta');   
    }

    public function lang()
    {

        $locale = $this->postLocales()->where('locale', \Lang::getLocale());

        if ($locale->count() > 0) {

            $lang = $locale->first();

            if ($lang->title != '' && $lang->content != '') return $lang;

        }

        return $this->postLocales()->where('locale', 'en')->first();

    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($post)
        {

        });

        static::updating(function($post)
        {

        });

        static::deleting(function($post)
        {

        });

        static::created(function($post)
        {

        });

        static::updated(function($post)
        {

        });

        static::deleted(function($post)
        {

        });

    }
}
