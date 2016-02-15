<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
    //
    public function customer() {

        return $this->belongsTo('App\Customer');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($testimony)
        {

        });

        static::updating(function($testimony)
        {

        });

        static::deleting(function($testimony)
        {

        });

        static::created(function($testimony)
        {

        });

        static::updated(function($testimony)
        {

        });

        static::deleted(function($testimony)
        {

        });

    }
}
