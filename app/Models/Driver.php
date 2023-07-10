<?php

namespace App\Models;

use App\Domains\Driver\v1\Enums\DriverProfileStep;
use App\Domains\Shared\v1\Traits\FirebaseDeviceTokensTrait;
use App\Domains\Shared\v1\Traits\PointsTrait;
use App\Domains\User\v1\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Propaganistas\LaravelPhone\PhoneNumber;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Driver extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, FirebaseDeviceTokensTrait, PointsTrait, InteractsWithMedia;

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
        'phone_verified_at',
        'id_number',
        'nationality',
        'city_id',
        'vehicle_type',
        'vehicle_brand',
        'vehicle_plate_number',
        'payment_service',
        'account_holder_name',
        'iban_number',
        'stc_number',
        'step',
        'is_active',
        'has_message',
        'status'
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

    /**
     * Get all of the comments for the Driver
     *
     * @return \Illuminate\Database\Eloquent\Relations\morphMany
     */
    public function images(){
        return $this->morphMany(Image::class, 'parentable');
    }

    /**
     * Get the city that owns the Driver
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
    /**
     * Get the user that owns the Driver
     *
     * @return Image
     */
    public function getIdNumberImageAttribute()
    {
        // return $this->images()->where('type','id_number_image')->first();
        return $this->getFirstMedia('images', [
            'type' => 'id_number_image'
        ])?->original_url;
    }

    /**
     * Get the profile image that owns the Driver
     *
     * @return Image
     */
    public function getProfileImageAttribute()
    {
        // return $this->images()->where('type','profile')->first();
        return $this->getFirstMedia('images', [
            'type' => 'profile'
        ])?->original_url;
    }

    /**
     * Get the profile image that owns the Driver
     *
     * @return Image
     */
    public function getDriverLicenseAttribute()
    {
        // return $this->images()->where('type','driver_license')->first();
        return $this->getFirstMedia('images', [
            'type' => 'driver_license'
        ])?->original_url;
    }

    /**
     * Get the profile image that owns the Driver
     *
     * @return Image
     */
    public function getIsProfileCompletedAttribute()
    {
        return $this->step == DriverProfileStep::STEP_THREE->value;
    }

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


    /**
     * Get all of the comments for the Driver
     *
     * @return \Illuminate\Database\Eloquent\Relations\morphMany
     */
    public function comments(){
        return $this->morphMany(Comment::class, 'notifiable');
    }

    /**
     * Get driver location
     *
     * @return \Illuminate\Database\Eloquent\Relations\morphMany
     */
    public function location(){
        return $this->morphOne(Location::class, 'locationable');
    }

    /**
     * Get all of the comments for the Driver
     *
     * @return \Illuminate\Database\Eloquent\Relations\morphMany
     */
    public function warningComment(){
        return $this->morphOne(Comment::class, 'notifiable')->where('reason', 'joining_as_driver')->orderBY('id','desc');
    }

    /**
     * Get driver location
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function setting(){
        return $this->hasOne(DriverSetting::class, 'driver_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class,'driver_id');
    }
    public function currentOrder()
    {
        return $this->orders()->where(function ($q)
        {
           $q->whereNotIn('status',[OrderStatusEnum::CANCELED_AND_RETURNED]);
        })->first();
    }
}
