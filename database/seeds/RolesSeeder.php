<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'id'    => 1,
                'title' => 'Admin',
            ],
            [
                'id'    => 2,
                'title' => 'Lawyer',
            ],
            [
                'id'    => 3,
                'title' => 'Super',
            ],
        ];

        Role::insert($roles);
    }
}
