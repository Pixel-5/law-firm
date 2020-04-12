<?php


namespace App\Repositories;


use App\User;

class UserRepository
{
    public function all()
    {
//        $users = User::all();
//
//        if (!empty($users)){
//            $users->load('roles');
//
//        }
        $users = User::whereHas('roles', function ($q) {
            //conditions from role table
            $q->Where('name', 'lawyer');

        })->
        // conditions from Usertable
        where('active_status', 1)->paginate(20);
    }
}
