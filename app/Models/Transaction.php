<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function driver()
    {
        return $this->morphTo(Driver::class,'userable');
    }
    public function user()
    {
        return $this->morphTo(User::class,'userable');
    }
}
