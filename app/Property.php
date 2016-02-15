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

    public function propertyMetas()
    {
        return $this->hasMany('App\PropertyMeta');
    }

    public function enquiries()
    {
        return $this->hasMany('App\Enquiry');
    }

    public function facilities()
    {
        return $this->hasMany('App\Facility');
    }

    public function documents()
    {
        return $this->hasMany('App\Document');
    }

    public function distances()
    {
        return $this->hasMany('App\Distance');
    }

    public function thumb()
    {
        return $this->propertyFiles()->where('type', 'image')->first();
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

    public function scopeFilterCategory($query, $category)
    {

        if (isset($category)) {

            $query->where(function ($q) use ($category) {

                $q->where('category_id', $category->id);

                if ($category->childs) {

                foreach ($category->childs as $key => $value) {
                        
                        $q->orWhere('category_id', $value->id);
                    }
                }
            });
            
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

        $propertyLanguages = $this->propertyLanguages()->where('locale', \Lang::getLocale());

        if ($propertyLanguages->count() > 0) {

            return $propertyLanguages->first();

        } else {

            return $this->propertyLanguages()->where('locale', 'en')->first();
        }
    }

    public function categoryName()
    {
        if ($this->category) {
            $categoryLanguages = $this->category->categoryLanguages()->where('locale', \Lang::getLocale());

            if ($categoryLanguages->count() > 0) {

                return $categoryLanguages->first()->title;

            } else {

                return $this->category->categoryLanguages()->where('locale', 'en')->first()->title;
            }

        } else {
            return '-';
        }

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
            if ($property->propertyLanguages) {

                $property->propertyLanguages()->delete();
            }

            if ($property->propertyFiles) {
                
                $property->propertyFiles()->delete();
            }
            
            if ($property->inquiries) {
                
                $property->inquiries()->delete();
            }
            
            if ($property->facilities) {
                
                $property->facilities()->delete();
            }
            
            if ($property->documents) {
                
                $property->documents()->delete();
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
