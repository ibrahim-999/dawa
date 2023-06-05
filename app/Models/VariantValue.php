<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class VariantValue extends Model
{
    use HasFactory;

    protected $table= 'product_variant';

    protected $fillable = [
        'product_id',
        'variant_id',
        'attribute_id',
        'attribute_value_id'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class)->with('translation');
    }
    public function attribute()
    {
        return $this->belongsTo(Attribute::class)->with('translation');
    }
    public function value()
    {
        return $this->belongsTo(AttributeValue::class,'attribute_value_id')->with('translation');
    }

}
