<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::factory()->count(100)->create()->each(function ($brand){
            // $brand->addMediaFromUrl(url(asset('brand/' . rand(1, 3) . '.jpeg')))->toMediaCollection('images');
        });
    }
}
