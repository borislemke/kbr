<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kbwebs\MultiAuth\PasswordResets\CanResetPassword;

use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

use Kbwebs\MultiAuth\PasswordResets\Contracts\CanResetPassword as CanResetPasswordContract;

class Customer extends Model implements AuthenticatableContract,
AuthorizableContract,
CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;
    
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


    public function testimonials() {

        return $this->hasMany('App\Testimony');
    }

    public function properties() {

        return $this->hasMany('App\Property');
    }

    public function enquiries() {

        return $this->hasMany('App\Enquiry');
    }

    public function getUsername($firstName) {
        $username = str_slug($firstName);
        $userRows  = $this->whereRaw("username REGEXP '^{$username}([0-9]*)?$'")->get();
        $countUser = count($userRows) + 1;

        return ($countUser > 1) ? "{$username}{$countUser}" : $username;
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($customer)
        {

        });

        static::updating(function($customer)
        {

        });

        static::deleting(function($customer)
        {

        });

        static::created(function($customer)
        {

        });

        static::updated(function($customer)
        {

        });

        static::deleted(function($customer)
        {

        });

    }
}
