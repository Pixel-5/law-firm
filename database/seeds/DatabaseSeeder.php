<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsSeeder::class,
            RolesSeeder::class,
            PermissionRoleSeeder::class,
            UsersSeeder::class,
            RoleUserSeeder::class,
            VenueSeeder::class,
        ]);
    }
}
