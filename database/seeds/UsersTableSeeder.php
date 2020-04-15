<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$KZ1AioruwI7TtKuMJCiu3.VyxwgnXBEFhKraK8wlkep9xqTEQeXny',
                'remember_token' => Str::random(10),
                'email_verified_at' => now(),
                'created_at'     => now()
            ],
            [
                'id'             => 2,
                'name'           => 'Lawyer',
                'email'          => 'lawyer@lawyer.com',
                'password'       => '$2y$10$KZ1AioruwI7TtKuMJCiu3.VyxwgnXBEFhKraK8wlkep9xqTEQeXny',
                'remember_token' => Str::random(10),
                'email_verified_at' => now(),
                'created_at'     => now()
            ],
        ];

        User::insert($users);
    }
}
