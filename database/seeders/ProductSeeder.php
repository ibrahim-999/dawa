<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory()->count(200)->create()->each(function ($product){

            Variant::factory()->count(rand(1,10))->create(['product_id'=>$product->id]);
            Attribute::factory()->count(rand(1,5))->create(['product_id'=>$product->id])->each(function ($attribute) use ($product)
            {
                AttributeValue::factory()->count(rand(1,5))->create(['attribute_id'=>$attribute->id]);
                foreach ($product->variants as $variant){
                    $variant->values()->create(
                        [
                            'product_id'=>$product->id,
                            'attribute_id'=>$attribute->id,
                            'attribute_value_id'=>$attribute->values->shuffle()->first()->id
                        ]
                    );
                }

            });

        });
    }
}
