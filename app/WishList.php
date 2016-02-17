<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    //
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function property()
    {
        return $this->belongsTo('App\Property');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($wishList)
        {

        });

        static::updating(function($wishList)
        {

        });

        static::deleting(function($wishList)
        {

        });

        static::created(function($wishList)
        {

        });

        static::updated(function($wishList)
        {

        });

        static::deleted(function($wishList)
        {

        });

    }

}
