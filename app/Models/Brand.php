<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Brand extends Model implements TranslatableContract
{
    use HasFactory,Translatable;

    public $translatedAttributes = ['title', 'description'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', 1);
    }


}
