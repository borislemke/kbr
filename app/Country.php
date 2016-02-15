<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    public function provinces()
    {
        return $this->hasMany('App\Province', 'country_iso', 'iso');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($country)
        {

        });

        static::updating(function($country)
        {

        });

        static::deleting(function($country)
        {

        });

        static::created(function($country)
        {

        });

        static::updated(function($country)
        {

        });

        static::deleted(function($country)
        {

        });

    }
    
}
