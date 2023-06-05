<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->order_code = $model->generateUniqueCode();
        });
    }

    public function generateUniqueCode () : string {
        $order = $this->orderBy('id','desc')->first();
        return "#".( $order ? ($order->id + 1) : '' ).time();
    }

    /**
     * Get all of the packages for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function packages(): HasMany  
    {
        return $this->hasMany(OrderPackage::class, 'order_id', 'id');
    }

    /**
     * Get the cart that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'id');
    }
    
    /**
     * Get the cart that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'address_id', 'id');
    }

    /**
     * Get all of the comments for the Driver
     *
     * @return \Illuminate\Database\Eloquent\Relations\morphMany
     */
    public function images(){
        return $this->morphOne(Image::class, 'parentable');
    }

    /**
     * Get all of the order history for the order
     *
     * @return \Illuminate\Database\Eloquent\Relations\morphMany
     */
    public function history(){
        return $this->hasMany(OrderHistory::class, 'order_id');
    }

    /**
     * Get all of the order history for the order
     *
     * @return \Illuminate\Database\Eloquent\Relations\morphMany
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
