<?php


namespace App\Facade;


use Illuminate\Support\Facades\Facade;

class UserRepository extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'UserRepository';
    }
}
