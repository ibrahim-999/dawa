<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities=config('cities');
        foreach ($cities as $city) {
            City::create([
                'name' => $city['name_en'],
                'en' => ['title' => $city['name_en']],
                'ar' => ['title' => $city['name_ar']],
            ]);
        }
    }
}
