<?php

namespace App\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class FileRepository
 * @package App\Facade
 */
class FileRepository extends Facade
{

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'FileRepository';
    }
}
