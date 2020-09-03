<?php


namespace App\Facade;


use Illuminate\Support\Facades\Facade;

class CompanyFileRepository extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'CompanyFileRepository';
    }
}
