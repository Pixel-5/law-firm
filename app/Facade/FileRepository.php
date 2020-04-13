<?php


namespace App\Facade;


use Illuminate\Support\Facades\Facade;

class FileRepository extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'FileRepository';
    }
}