<?php

namespace App\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class UserRepository
 * @package App\Facade
 */
class UserRepository extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'UserRepository';
    }
}
