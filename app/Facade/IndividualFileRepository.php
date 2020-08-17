<?php


namespace App\Facade;


use Illuminate\Support\Facades\Facade;

class IndividualFileRepository extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'IndividualFileRepository';
    }
}
