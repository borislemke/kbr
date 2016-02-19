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

    public function scopeAccess($query)
    {
        $user = \Auth::user()->get();

        // agent
        if ($user->role_id == 4 or $user->role_id == 3) {
            $query->join('properties', 'properties.id', '=', 'enquiries.property_id')
                ->where('properties.user_id', $user->id);
        }

        // super agent or manager
        if ($user->role_id == 2) {

            $query->join('properties', 'properties.id', '=', 'enquiries.property_id')
                ->join('users', 'users.id', '=', 'properties.user_id')
                ->where('users.branch_id', $user->branch_id);
        }

        return $query;
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
