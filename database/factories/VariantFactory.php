<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Variant>
 */
class VariantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $arabic_faker=\Faker\Factory::create('ar_EG');
        return [
            'en' => ['title' => $this->faker->text(50),'description'=>$this->faker->paragraph(10)],
            'ar' => ['title' => $arabic_faker->text(50),'description'=>$arabic_faker->paragraph(10)],
            'price'=>rand(1.1,5000),
            'discount_percentage'=>rand(0.1,100),
        ];
    }
}
