<?php

namespace App\Models;

use App\Documentation\User\Api\V1\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Variant extends Model implements TranslatableContract, HasMedia
{
    use HasFactory, Translatable, InteractsWithMedia;

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
        return $this->hasMany(Wishlist::class,'variant_id','id');
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
    public function getCurrentCartQuantityAttribute()
    {
        return ($this->currentCart()) ?(int)$this->currentCart()?->pivot->quantity ?? 0 : 0;
    }
    public function getIsWishlistedAttribute()
    {
        return $this->inWishlist(auth('sanctum')->user()?->id);
    }

    /**
     * Get the profile image that owns the Driver
     *
     * @return Image
     */
    public function getMainImageAttribute()
    {
        // return $this->images()->where('type','profile')->first();
        return $this->getFirstMedia('images', [
            'type' => 'main'
        ])?->original_url;
    }

    /**
     * Get the profile image that owns the Driver
     *
     * @return Image
     */
    public function getSubImagesAttribute()
    {
        // return $this->images()->where('type','profile')->first();
        return $this->getMedia('images', [
            'type' => 'sub'
        ]);
    }

    /**
     * Get the profile image that owns the Driver
     *
     * @return Image
     */
    public function getSubImagesArrayAttribute()
    {
        $data = [];
        $images = $this->sub_images;
        foreach ($images as $image) {
           $data[] = $image->original_url;
        }
        return $data;
    }
}
