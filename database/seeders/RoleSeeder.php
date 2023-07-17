<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'super admin']);
        $role2 = Role::create(['name' => 'admin']);
        $role3 = Role::create(['name' => 'guest']);
    }
}
