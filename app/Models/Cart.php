<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'place_id', 'address_id', 'is_current', 'order_id', 'coupon_id', 'discount'];

    public function variants()
    {
        return $this->belongstoMany(Variant::class)
            ->with('translation')
            ->withPivot('quantity', 'initial_price', 'is_modified', 'modification_type', 'modification_value');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(City::class, 'place_id');
    }

    public function getTotalQuantityAttribute()
    {
        return $this->variants()->sum('quantity');
    }

    public function getTotalPriceAttribute()
    {
        return $this->variants->sum(function ($variant) {
            return $variant->pivot->quantity * $variant->net_price;
        });
    }
}
