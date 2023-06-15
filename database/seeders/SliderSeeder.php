<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $sliders = Slider::factory( 10)->create();

        foreach($sliders as $slider){
            $slider
                ->addMedia((public_path('slider/' . rand(1, 3) . '.jpeg')))
                ->toMediaCollection('image');
        }
    }
}
