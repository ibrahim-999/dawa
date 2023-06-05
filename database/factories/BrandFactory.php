<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    use WithFaker;
    protected $model = Brand::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $arabic_faker=\Faker\Factory::create('ar_EG');
        return [
            'en' => ['title' => $this->faker->company,'description'=>$this->faker->paragraph(10)],
            'ar' => ['title' => $arabic_faker->company,'description'=>$arabic_faker->paragraph(10)],
        ];
    }
}
