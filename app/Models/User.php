<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Domains\Shared\v1\Traits\FirebaseDeviceTokensTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Propaganistas\LaravelPhone\PhoneNumber;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, FirebaseDeviceTokensTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getNationalPhoneNumberAttribute()
    {
        $phoneInstance = null;
        try {
            $getPhone = new PhoneNumber($this->phone);

            $phoneInstance = $getPhone->formatForMobileDialingInCountry($getPhone->getCountry());
        } catch (\Throwable $e) {
        }

        return $phoneInstance;
    }


    /**
     * Get the user role
     *
     * @return string
     */
    public function getPhoneCountryCodeAttribute()
    {
        $getCountry = null;
        try {
            $getCountry = (new PhoneNumber($this->phone))->getCountry();
        } catch (\Throwable $e) {
        }
        return $getCountry;
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * Get all of the comments for the Driver
     *
     * @return \Illuminate\Database\Eloquent\Relations\morphMany
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'parentable');
    }

    /**
     * Get the profile image that owns the Driver
     *
     * @return Image
     */
    public function getProfileImageAttribute()
    {
        return $this->images()->where('type', 'profile')->first();
    }

    /**
     * Get all of the comments for the Driver
     *
     * @return \Illuminate\Database\Eloquent\Relations\morphMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'notifiable');
    }

    /**
     * Get driver location
     *
     * @return \Illuminate\Database\Eloquent\Relations\morphMany
     */
    public function location()
    {
        return $this->morphOne(Location::class, 'locationable');
    }

    public function campaignable()
    {
        return $this->morphMany(Campaignable::class, 'campaignable');
    }
}
