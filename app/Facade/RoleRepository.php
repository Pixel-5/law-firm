<?php


namespace App\Facade;


use Illuminate\Support\Facades\Facade;

class RoleRepository extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'RoleRepository';
    }
}
