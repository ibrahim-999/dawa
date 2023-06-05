<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings=config('settings');
        foreach ($settings as $setting) {
            Setting::create([
                'key' => $setting['key'],
                'en' => $setting['values']['en'],
                'ar' => $setting['values']['ar']
            ]);
        }
    }
}
