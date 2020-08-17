<?php

namespace App\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class RoleRepository
 * @package App\Facade
 */
class RoleRepository extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'RoleRepository';
    }
}
