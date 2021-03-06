<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function pageLocales()
    {
        return $this->hasMany('App\PageLocale');
    }

    public function pageTerms()
    {
        return $this->hasMany('App\PageTerm');   
    }

    public function pageMetas()
    {
        return $this->hasMany('App\PageMeta');   
    }

    public function lang()
    {

        $locale = $this->pageLocales()->where('locale', \Lang::getLocale());

        if ($locale->count() > 0) {

            $lang = $locale->first();

            if ($lang->title != '' && $lang->content != '') return $lang;

        }

        return $this->pageLocales()->where('locale', 'en')->first();

    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($page)
        {

        });

        static::updating(function($page)
        {

        });

        static::deleting(function($page)
        {
            $page->pageLocales()->delete();
        });

        static::created(function($page)
        {

        });

        static::updated(function($page)
        {

        });

        static::deleted(function($page)
        {

        });

    }
}
