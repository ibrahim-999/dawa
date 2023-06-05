<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorAccess extends Model
{
    use HasFactory;


    protected $table='accessibles';

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
