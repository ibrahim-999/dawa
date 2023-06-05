<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chain extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'info',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function pharmacies(){
        return $this->hasMany(Pharmacy::class);
    }
    public function accesses(){
        return $this->morphToMany(Vendor::class,'accessible')->withPivot('id as access_id');
    }
}
