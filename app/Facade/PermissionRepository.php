<?php

namespace App\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class PermissionRepository
 * @package App\Facade
 */
class PermissionRepository extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'PermissionRepository';
    }
}
