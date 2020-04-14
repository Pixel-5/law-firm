<?php


namespace App\Facade;


use Illuminate\Support\Facades\Facade;

class ScheduleRepository extends Facade
{
protected static function getFacadeAccessor()
{
    return 'ScheduleRepository';
}
}
