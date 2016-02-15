<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
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
