<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'info',
        'chain_id',
        'address',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function accesses(){
        return $this->morphToMany(Vendor::class,'accessible')->withPivot('id as access_id');
    }
    public function chain()
    {
        return $this->belongsTo(Chain::class);
    }
}
