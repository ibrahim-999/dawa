<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    /**
     * Get all of the owning commentable models.
     */
    public function Locationable()
    {
        return $this->morphTo();
    }
}
