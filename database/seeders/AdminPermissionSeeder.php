<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminPermissionSeeder extends Seeder
{

    /**
     * @return void
     * create all admin permissions
     */
    public function run(): void
    {
        $permissions=config('admin-permissions');
        foreach ($permissions as $permission)
        {
            Permission::updateOrCreate(
                $permission,$permission
            );
        }

    }
}
