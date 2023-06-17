<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotificationCenterTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['title', 'description', 'subject'];
}
