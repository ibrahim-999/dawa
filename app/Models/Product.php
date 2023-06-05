<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Product extends Model implements TranslatableContract
{
    use HasFactory,Translatable;

    public $translatedAttributes = ['title', 'description'];
    public $fillable = ['category_id', 'sub_category_id' ,'subset_category_id','brand_id'];


    public function category()
    {
        return $this->belongsTo(Category::class,'category_id')->with('translation');
    }
    public function sub_category()
    {
        return $this->belongsTo(Category::class,'sub_category_id')->with('translation');
    }
    public function subset_category()
    {
        return $this->belongsTo(Category::class,'subset_category_id')->with('translation');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class)->with('translation');
    }
    public function variants()
    {
        return $this->hasMany(Variant::class)->with('translation');
    }
    public function attributes()
    {
        return $this->hasMany(Attribute::class)->with('translation');
    }
    public function values()
    {
        return $this->hasMany(VariantValue::class);
    }

}
