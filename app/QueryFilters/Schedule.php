<?php


namespace App\QueryFilters;


use Closure;
use Illuminate\Support\Carbon;

class Schedule
{

    public function handle($request, Closure $next)
    {
        if (request()->has([ 'start_time', 'end_time'])){

            $builder = $next($request)->first();
            $start_time = Carbon::createFromFormat('Y-m-d H:i:s',$builder->start_time);
            $end_time = Carbon::createFromFormat('Y-m-d H:i:s',$builder->end_time);
            $req_time = Carbon::createFromFormat('Y-m-d H:i:s',request('start_time'));
            $req_time = Carbon::createFromFormat('Y-m-d H:i:s',request('end_time'));
           if ($req_time->between($start_time,$end_time))
               return $builder;

        }
        return $next($request);
    }

}
