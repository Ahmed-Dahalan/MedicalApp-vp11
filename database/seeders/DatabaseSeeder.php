<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Permission::create(['name' => 'Create-city', 'guard_name' => 'patient']);
        Permission::create(['name' => 'Read-cities', 'guard_name' => 'patient']);
        Permission::create(['name' => 'Update-city', 'guard_name' => 'patient']);
        Permission::create(['name' => 'Delete-city', 'guard_name' => 'patient']);
    }
}
