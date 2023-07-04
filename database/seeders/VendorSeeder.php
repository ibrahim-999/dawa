<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vendor::create([
            'name'=>'Super Vendor',
            'email'=>'dawafastvendor@dawafast.com',
            'password'=>Hash::make('DawaFast@123#'),
        ])->syncRoles('super_vendor');
    }
}
