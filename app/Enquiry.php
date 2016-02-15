<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    //
    public function property()
    {
        return $this->belongsTo('App\property');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($enquiry)
        {

        });

        static::updating(function($enquiry)
        {

        });

        static::deleting(function($enquiry)
        {

        });

        static::created(function($enquiry)
        {

        });

        static::updated(function($enquiry)
        {

        });

        static::deleted(function($enquiry)
        {

        });

    }
}
