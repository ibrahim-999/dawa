<?php

namespace App\Models;

use App\Domains\Shared\v1\Traits\FirebaseDeviceTokensTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Vendor extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable,HasRoles,FirebaseDeviceTokensTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_login_at',
        'last_login_ip_address',
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
        'last_login_at' => 'datetime',
    ];
    protected $guard_name = 'web-vendor';
    public function pharmacies()
    {
        return $this->morphedByMany(Pharmacy::class, 'accessible');
    }
    public function chains()
    {
        return $this->morphedByMany(Chain::class, 'accessible');
    }
    public function chainPharmacies()
    {
        return $this->hasManyThrough(Pharmacy::class,Chain::class);
    }
    public function campaignable(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Campaignable::class, 'campaignable');
    }


}
