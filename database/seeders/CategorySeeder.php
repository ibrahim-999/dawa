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
        Category::factory()->count(50)->create()->each(function ($category){
            Category::factory()->count(10)->create(['parent_id'=>$category->id])->each(function ($sub_category){
                Category::factory()->count(5)->create(['parent_id'=>$sub_category->id]);
            });
        });
    }
}
