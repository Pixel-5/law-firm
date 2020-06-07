<?php

namespace App\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class CaseRepository
 * @package App\Facade
 */
class CaseRepository extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'CaseRepository';
    }
}
