<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Brand extends Model implements TranslatableContract, HasMedia
{
    use HasFactory, Translatable, InteractsWithMedia;

    public $translatedAttributes = ['title', 'description'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', 1);
    }

    /**
     * Get the profile image that owns the Driver
     *
     * @return Image
     */
    public function getImageAttribute()
    {
        return $this->getFirstMedia('images')?->original_url;
    }

}
