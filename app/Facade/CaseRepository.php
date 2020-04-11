<?php


namespace App\Facade;


class CaseRepository
{
    public static function __callStatic($method, $arguments)
    {
        // TODO: Implement __callStatic() method.
        return (self::resolveFacade('FileRepository'))
            ->$method(...$arguments);
    }

    public static function resolveFacade($name)
    {
        return app()->make($name);
    }
}
