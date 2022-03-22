<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Permission::create(['name' => 'Create-', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-', 'guard_name' => 'admin']);


        Permission::create(['name' => 'Create-city', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-cities', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-city', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-city', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-admins', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-admin', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-patient', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-patients', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-patient', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-patient', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-roles', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-role', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-permission', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-permissions', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-permission', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-permission', 'guard_name' => 'admin']);


        // Permission::create(['name' => 'Create-city', 'guard_name' => 'patient']);
        // Permission::create(['name' => 'Read-cities', 'guard_name' => 'patient']);
        // Permission::create(['name' => 'Update-city', 'guard_name' => 'patient']);
        // Permission::create(['name' => 'Delete-city', 'guard_name' => 'patient']);
    }
}
