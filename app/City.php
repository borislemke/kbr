<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    public function province()
    {
        return $this->belongsTo('App\Province');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($city)
        {

        });

        static::updating(function($city)
        {

        });

        static::deleting(function($city)
        {

        });

        static::created(function($city)
        {

        });

        static::updated(function($city)
        {

        });

        static::deleted(function($city)
        {

        });

    }

}
