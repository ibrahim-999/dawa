<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model implements TranslatableContract
{
    use HasFactory, \Astrotomic\Translatable\Translatable;

    protected $fillable = ['attribute_id','code'];
    public $translatedAttributes = ['name'];

    public function values()
{
    return $this->hasMany(VariantValue::class);
}
}
