<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Variant>
 */
class AnswerFactory extends Factory
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
            'en' => ['title' => $this->faker->text()],
            'ar' => ['title' => $arabic_faker->text()],
        ];
    }
}
