<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPackage extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function pharmacy(){
        return $this->belongsTo(Pharmacy::class);
    }
    public function variant(){
        return $this->belongsTo(Variant::class);
    }
}
