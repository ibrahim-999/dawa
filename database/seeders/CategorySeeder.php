<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->count(7)->create()->each(function ($category){
            $category->addMediaFromUrl(url(asset('category/' . rand(1, 3) . '.jpeg')))->toMediaCollection('images');
            Category::factory()->count(5)->create(['parent_id'=>$category->id])->each(function ($sub_category){
                $sub_category->addMediaFromUrl(url(asset('category/' . rand(1, 3) . '.jpeg')))->toMediaCollection('images');
                Category::factory()->count(3)->create(['parent_id'=>$sub_category->id])->each(function ($cat){
                    $cat->addMediaFromUrl(url(asset('category/' . rand(1, 3) . '.jpeg')))->toMediaCollection('images');
                });;
            });
        });
    }
}