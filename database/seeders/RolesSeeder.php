<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $role = Role::create(['name' => 'super admin']);
        $role = Role::create(['name' => 'admin']);
        $role = Role::create(['name' => 'instructor']);
        $role = Role::create(['name' => 'student']);
    }
}
