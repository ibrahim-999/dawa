<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            AdminPermissionSeeder::class,
            RoleSeeder::class,
            AdminSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            CitySeeder::class,
            SettingSeeder::class,
            QuestionSeeder::class,
//            SliderSeeder::class,
            VendorSeeder::class,
            UserSeeder::class,
        ]);
    }
}
