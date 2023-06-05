<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $arabic_faker=\Faker\Factory::create('ar_EG');
        $category=Category::whereNull('parent_id')->get()->shuffle()->first();
        $sub_category=$category->childs->shuffle()->first();
        $subset_category=$sub_category->childs->shuffle()->first();
        $brand=Brand::all()->shuffle()->first();
        return [
            'en' => ['title' => $this->faker->company,'description'=>$this->faker->paragraph(10)],
            'ar' => ['title' => $arabic_faker->company,'description'=>$arabic_faker->paragraph(10)],
            'category_id'=>$category?->id,
            'sub_category_id'=>$sub_category?->id,
            'subset_category_id'=>$subset_category?->id,
            'brand_id'=>$brand?->id,
        ];
    }
}
