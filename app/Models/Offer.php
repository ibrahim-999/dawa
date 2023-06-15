<?php

namespace App\Models;

use App\Domains\User\v1\Enums\OfferProductTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Offer extends Model implements TranslatableContract, HasMedia
{
    use HasFactory, Translatable, SoftDeletes, InteractsWithMedia;

    public $translatedAttributes = ['title', 'description'];

    public $fillable = ['start_date', 'end_date', 'discount_type', 'discount', 'buy_amount', 'get_amount'];

    public function variants()
    {
        return $this->belongsToMany(Variant::class, 'offer_variants', 'offer_id', 'variant_id');
    }

    public function offerVariants()
    {
        return $this->hasMany(OfferVariant::class, 'offer_id', 'id');
    }


    public function offerGetVariants()
    {
        return $this->hasMany(OfferVariant::class, 'offer_id', 'id')->where('type', OfferProductTypeEnum::GET->value);
    }

    public function offerBuyVariants()
    {
        return $this->hasMany(OfferVariant::class, 'offer_id', 'id')->where('type', OfferProductTypeEnum::BUY->value);
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

        if ( ($startDate->gte($dateNow) || $startDate->lte($dateNow) ) && $endDate->gte($dateNow)) {
            return true;
        }
        
        return false;
    }

    public function getVariants()
    {
        return $this->belongsToMany(Variant::class, 'offer_variants', 'offer_id', 'variant_id')->wherePivot('type', OfferProductTypeEnum::GET->value);
    }

    public function buyVariants()
    {
        return $this->belongsToMany(Variant::class, 'offer_variants', 'offer_id', 'variant_id')->wherePivot('type', OfferProductTypeEnum::BUY->value);
    }

}
