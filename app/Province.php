<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    //
    public function country()
    {
        return $this->belongsTo('App\Country', 'country_iso', 'iso');
    }

    public function cities()
    {
        return $this->hasMany('App\City');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($province)
        {

        });

        static::updating(function($province)
        {

        });

        static::deleting(function($province)
        {

        });

        static::created(function($province)
        {

        });

        static::updated(function($province)
        {

        });

        static::deleted(function($province)
        {

        });

    }

}
