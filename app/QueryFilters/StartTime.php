<?php


namespace App\QueryFilters;


use Carbon\Carbon;

/**
 * Class StartTime
 * @package App\QueryFilters
 */
class StartTime extends BaseFilter
{

    /**
     * @param $builder
     * @return mixed
     */
    public function applyFilter($builder)
    {

        $start_time = Carbon::createFromFormat('Y-m-d H:i:s',request('start_time'));
        $end_time = Carbon::createFromFormat('Y-m-d H:i:s',request('end_time'));
        return $builder->where('start_time','<=',$start_time)
            ->where('end_time','>',$start_time)
            ->where( 'venue',request('venue'))

            ->orWhere('start_time','>=',$start_time)
            ->where('start_time','<',$end_time)
            ->where( 'venue',request('venue'));
    }
}
