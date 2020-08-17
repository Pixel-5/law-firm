<?php


namespace App\QueryFilters;

use Closure;
use Illuminate\Support\Str;

/**
 * Class BaseFilter
 * @package App\QueryFilters
 */
abstract class BaseFilter
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!request()->has($this->filterName())){
            return $next($request);
        }
        $builder = $next($request);

        return $this->applyFilter($builder);
    }

    /**
     * @param $builder
     * @return mixed
     */
    public function applyFilter($builder)
    {
        return $builder->where($this->filterName(),request($this->filterName()));
    }

    /**
     * @return string
     */
    public function filterName()
    {
        return Str::snake(class_basename($this));
    }
}
