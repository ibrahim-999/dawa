<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirebaseDeviceToken extends Model
{
    use HasFactory;

    protected $fillable=[
        'device_id',
        'device_token',
        'device_type',
        'notifiable_id',
        'notifiable_type',
    ];
}