<?php

namespace App\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class ScheduleRepository
 * @package App\Facade
 */
class ScheduleRepository extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ScheduleRepository';
    }
}
