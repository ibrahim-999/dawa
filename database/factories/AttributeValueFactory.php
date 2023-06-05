<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attribute>
 */
class AttributeValueFactory extends Factory
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
            'en' => ['name' => $this->faker->text(5)],
            'ar' => ['name' => $arabic_faker->text(5)],
            'code' => $this->faker->text('5')
        ];
    }
}
