<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignNotification extends Model
{
    use HasFactory, Translatable, SoftDeletes;

    public $translatedAttributes = ['title', 'description', 'subject'];

    public $fillable = ['type', 'user_type', 'date', 'time', 'sent_type', 'sent_type', 'status'];

    public function vendors()
    {
        return $this->morphMany(Vendor::class, 'campaignable');
    }

    public function customers()
    {
        return $this->morphMany(User::class, 'campaignable');
    }
}
