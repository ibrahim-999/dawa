<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coupon extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "code" ,
        "start_date",
        "end_date" ,
        "discount_type",
        "discount",
        "min_purchases",
        "max_discount",
        "num_uses_person",
        "num_uses",
    ];

    /**
     * Get all of the catgegories for the Coupon
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories(): HasMany
    {
        return $this->hasMany(CouponCategoryProduct::class, 'coupon_id', 'id')->where('model_type', 'category');
    }

    /**
     * Get all of the products for the Coupon
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(CouponCategoryProduct::class, 'coupon_id', 'id')->where('model_type', 'product');
    }

    /**
     * Get all of the usages for the Coupon
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usages(): HasMany
    {
        return $this->hasMany(CouponUsage::class, 'coupon_id', 'id');
    }

    /**
     * Get the user role
     *
     * @return string
     */
    public function getIsActiveAttribute()
    {
        $dateNow = Carbon::now();

        $startDate = Carbon::createFromFormat('Y-m-d', $this->start_date);
        $endDate = Carbon::createFromFormat('Y-m-d', $this->end_date);

        if ( $dateNow->gte($startDate) && $endDate->gte($dateNow)) {
            return true;
        }

        $couponPersonUsagesCount = CouponUsage::where('coupon_id',$this->id)->where('status',1)->count();
        $couponAllUsagesCount = CouponUsage::where('coupon_id',$this->id)->where('status',1)->count();

        if ($couponPersonUsagesCount < $this->num_uses_person && $couponAllUsagesCount <  $this->num_uses) {
            return true;
        }
        
        return false;
    }
}
