<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CouponCategoryProduct extends Model
{
    use HasFactory;

    protected $table = 'coupon_category_product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "coupon_id" ,
        "model_id",
        "model_type" ,
    ];

    /**
     * Get all of the catgegories for the Coupon
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'model_id', 'id');
    }

    /**
     * Get all of the catgegories for the Coupon
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'model_id', 'id');
    }
}
