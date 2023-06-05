<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Attribute extends Model implements TranslatableContract
{
    use HasFactory,Translatable;

    protected $fillable = ['product_id','type'];
    public $translatedAttributes = ['name'];

    public function values()
    {
        return $this->hasMany(AttributeValue::class,'attribute_id','id')->with('translation');
    }
}
