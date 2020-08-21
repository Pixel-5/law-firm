<?php


namespace App\Facade;


use Illuminate\Support\Facades\Facade;

class ClientRepository extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ClientRepository';
    }
}
