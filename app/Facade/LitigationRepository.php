<?php


namespace App\Facade;


use Illuminate\Support\Facades\Facade;

class LitigationRepository extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'LitigationRepository';
    }
}
