<?php

namespace App\Models;

use App\Documentation\User\Api\V1\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Variant extends Model implements TranslatableContract
{
    use HasFactory,Translatable;
    use HasFactory;

    public $fillable = ['price', 'discount_percentage', 'is_active','product_id'];
    public $translatedAttributes = ['title', 'description','specifications'];

    public function product()
    {
        return $this->belongsTo(Product::class)->with('translation');
    }


    public function values()
    {
        return $this->hasMany(VariantValue::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function inWishlist($userId)
    {
        return (bool) $this->wishlists()->where('user_id',$userId)->exists();
    }

    /**
     * Get all of the review for the Variant
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
    public function getNetPriceAttribute()
    {
        return round($this->price - (($this->discount_percentage * $this->price)/100));
    }
    public function carts()
    {
        return $this->belongstoMany(Cart::class)
            ->withPivot('quantity','initial_price','is_modified','modification_type','modification_value');
    }
    public function currentCart()
    {
        return $this->carts()
            ->where('order_id', null)
            ->where('is_current', 1)
            ->where('user_id',auth('sanctum')?->id())
            ->where('place_id',request()->header('X-Place'))
            ->first();
    }
}
