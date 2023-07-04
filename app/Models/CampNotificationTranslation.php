<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampNotificationTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = ['title', 'description', 'subject'];
}
