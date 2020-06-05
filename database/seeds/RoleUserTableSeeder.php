<?php

use App\User;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    public function run()
    {
        User::findOrFail(1)->roles()->sync(1);
        User::findOrFail(2)->roles()->sync(2);
        User::findOrFail(3)->roles()->sync(3);
//        for ($index = 4, $index <= 100; $index++;){
//            User::findOrFail(3)->roles()->sync(random_int(1,3));
//        }
    }
}
