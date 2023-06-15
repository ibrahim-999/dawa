<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class Slider extends Model implements TranslatableContract, HasMedia
{
    use HasFactory, Translatable, InteractsWithMedia;

    public $translatedAttributes = ['title'];
    protected $guarded = ['id'];

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', 1);
    }
    public static function getConversionName() : string
    {
        return 'thumbnail';
    }
    public static function getCollectionName() : string
    {
        return 'image';
    }
    public function registerMediaConversions(Media $media = null) : void
    {
        $this->addMediaConversion($this->getConversionName())
            ->keepOriginalImageFormat()
            ->performOnCollections($this->getCollectionName());
    }
    public function registerMediaCollections() : void
    {
        $this->addMediaCollection($this->getCollectionName())->acceptsMimeTypes(
            [
                'image/jpeg',
                'image/png',
            ]
        )
            ->singleFile();
    }

}
