<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // optional
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function propertyLocales()
    {
        return $this->hasMany('App\PropertyLocale');
    }

    public function galleries()
    {
        return $this->hasMany('App\Attachment', 'object_id')
            ->where('type', 'img')
            ->where('name', 'property');
    }

    public function attachments()
    {
        return $this->hasMany('App\Attachment', 'object_id')->where('name', 'property');
    }

    public function propertyMetas()
    {
        return $this->hasMany('App\PropertyMeta');
    }

    public function propertyTerms()
    {
        return $this->hasMany('App\PropertyTerm');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Term', 'property_terms')->where('type', 'property_category');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Term', 'property_terms')->where('type', 'property_tag');
    }

    public function terms()
    {
        return $this->belongsToMany('App\Term', 'property_terms');
    }

    public function enquiries()
    {
        return $this->hasMany('App\Enquiry');
    }

    public function category()
    {
        return $this->select('terms.*')
            ->join('property_terms', 'property_terms.property_id', '=', 'properties.id')
            ->join('terms', 'terms.id', '=', 'property_terms.term_id')
            ->where('terms.type', 'property_category')
            ->first();
    }

    public function scopeCategoryChild($query, $terms){        

        foreach ($terms as $key => $term) {

            // filter category
            $query = $query->orWhere('terms.slug', $term->slug);

            // check child category
            if ($term->childs) {

                $query = $this->scopeCategoryChild($query, $term->childs);
            }
        }

        return $query;
    }

    public function scopeAccess($query)
    {
        $user = \Auth::user()->get();

        // agent
        if ($user->role_id == 4) $query->where('properties.user_id', $user->id);

        // super agent or manager
        if ($user->role_id == 2 or $user->role_id == 3) {

            $query->join('users', 'users.id', '=', 'properties.user_id')
                ->where('users.branch_id', $user->branch_id);
        }

        return $query;
    }

    public function thumb()
    {
        return $this->propertyMetas()->where('type', 'thumbnail');
    }

    public function scopeFilterPrice($query, $minprice, $maxprice)
    {
        if (isset($minprice) && empty($maxprice)) {

            $query->where('price', '>=', $minprice);
        }

        if (empty($minprice) && isset($maxprice)) {

            $query->where('price', '<=', $maxprice);
        }

        if (isset($minprice) && isset($maxprice)) {

            $query->whereBetween('price', [$minprice, $maxprice]);
        }

        return $query;
    }

    public function scopeFilterLocation($query, $lat, $lon, $rad)
    {
        if (isset($lat) && isset($lon) && isset($rad)) {

            $query->whereBetween('map_latitude', [$lat - $rad, $lat + $rad])
                ->whereBetween('map_longitude', [$lon - $rad, $lon + $rad]);
        }

        return $query;
    }

    public function lang()
    {

        $locale = $this->propertyLocales()->where('locale', \Lang::getLocale());

        if ($locale->count() > 0) {

            $lang = $locale->first();

            if ($lang->title != '' && $lang->content != '') return $lang;

        }

        return $this->propertyLocales()->where('locale', 'en')->first();

    }

    public function localeEN()
    {
        return $this->propertyLocales()->where('locale', 'en')->first();
    }

    public function facilities()
    {
        return $this->hasMany('App\PropertyMeta')->where('type', 'facility');
    }

    public function distances()
    {
        return $this->hasMany('App\PropertyMeta')->where('type', 'distance');
    }

    public function documents()
    {
        return $this->hasMany('App\PropertyMeta')->where('type', 'document');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($property)
        {

        });

        static::updating(function($property)
        {

        });

        static::deleting(function($property)
        {
            if ($property->propertyLocales) {

                $property->propertyLocales()->delete();
            }

            if ($property->attachments) {
                
                $property->attachments()->delete();
            }
            
            if ($property->enquiries) {
                
                $property->enquiries()->delete();
            }
            
            if ($property->propertyMetas) {
                
                $property->propertyMetas()->delete();
            }

        });

        static::created(function($property)
        {
            Model::unguard();

            // en id fr ru
            // if ($property->propertyLanguages()->count() == 0) {

                // $property->propertyLanguages()->saveMany([
                //     factory(\App\PropertyLanguage::class)->make(),
                //     new \App\PropertyLanguage(['locale' => 'id', 'title' => '']),
                //     new \App\PropertyLanguage(['locale' => 'fr', 'title' => '']),
                //     new \App\PropertyLanguage(['locale' => 'ru', 'title' => ''])
                // ]);

            //     $property->propertyLanguages()->save(factory(\App\PropertyLanguage::class)->make());
                
            // }

            // if ($property->documents()->count() == 0) {

            //     $property->documents()->saveMany([
            //         new \App\Document(['name' => 'Agent Agreement']),
            //         new \App\Document(['name' => 'Pondok Wisata Lcs']),
            //         new \App\Document(['name' => 'Tax Construction']),
            //         new \App\Document(['name' => 'Photographs']),
            //         new \App\Document(['name' => 'IMB']),
            //         new \App\Document(['name' => 'Land Certf.']),
            //         new \App\Document(['name' => 'Notary Details']),
            //         new \App\Document(['name' => 'Owner KTP'])
            //     ]);

            // }

            // if ($property->facilities()->count() == 0) {

            //     $property->facilities()->saveMany([
            //         new \App\Facility(['name' => 'Bedroom']),
            //         new \App\Facility(['name' => 'Bathroom']),
            //         new \App\Facility(['name' => 'Sale in Furnish'])
            //     ]);
                
            // }

            Model::reguard();

        });

        static::updated(function($property)
        {

        });

        static::deleted(function($property)
        {

        });

    }

}
