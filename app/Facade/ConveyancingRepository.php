<?php


namespace App\Facade;


use Illuminate\Support\Facades\Facade;

class ConveyancingRepository extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ConveyancingRepository';
    }
}
