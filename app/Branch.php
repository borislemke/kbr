<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    //
    public function users() {
        return $this->hasMany('App\User');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($branch)
        {

        });

        static::updating(function($branch)
        {

        });

        static::deleting(function($branch)
        {

        });

        static::created(function($branch)
        {

        });

        static::updated(function($branch)
        {

        });

        static::deleted(function($branch)
        {

        });

    }
}
