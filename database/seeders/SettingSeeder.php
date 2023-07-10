<?php

namespace Database\Seeders;

use App\Domains\Shared\v1\Enums\SettingGroupEnum;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings=config('settings.general');
        foreach ($settings as $setting) {
            Setting::create([
                'key' => $setting['key'],
                'en' => $setting['values']['en'],
                'ar' => $setting['values']['ar']
            ]);
        }

        $loyaltySettings=config('settings.loyalty_points');
        foreach ($loyaltySettings as $setting) {
            Setting::create([
                'key' => $setting['key'],
                'is_fixed' => $setting['is_fixed'],
                'fixed_value' => $setting['fixed_value'],
                'group' => $setting['group']
            ]);
        }

        $loyaltyPointActions=config('settings.loyalty_point_actions');
        foreach ($loyaltyPointActions as $setting) {
            Setting::create([
                'key' => $setting['key'],
                'is_fixed' => $setting['is_fixed'],
                'fixed_value' => $setting['fixed_value'],
                'group' => $setting['group']
            ]);
        }
    }
}
