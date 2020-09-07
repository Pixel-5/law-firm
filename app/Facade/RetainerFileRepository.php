<?php


namespace App\Facade;


use Illuminate\Support\Facades\Facade;

class RetainerFileRepository extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'RetainerFileRepository';
    }
}
