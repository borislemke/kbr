<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    //
    protected $table = 'PostCategories';

    public function languages() {

        return $this->hasMany('App\PostCategoryLanguages');
    }

    public function post() {

        return $this->belongsTo('App\Post');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($postCategory)
        {

        });

        static::updating(function($postCategory)
        {

        });

        static::deleting(function($postCategory)
        {

        });

        static::created(function($postCategory)
        {

        });

        static::updated(function($postCategory)
        {

        });

        static::deleted(function($postCategory)
        {

        });

    }
    
}
