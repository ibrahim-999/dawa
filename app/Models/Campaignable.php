<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Campaignable extends Model
{
    use HasFactory;

    protected $table = 'campaignable';

    protected $fillable = [
        'title', 'description', 'subject', 'notification_type', 'campaignable_id', 'campaignable_type'
    ];
}
