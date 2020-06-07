<?php


namespace App\QueryFilters;


use Carbon\Carbon;

/**
 * Class EndTime
 * @package App\QueryFilters
 */
class EndTime extends BaseFilter
{

    /**
     * @param $builder
     * @return mixed
     */
    public function applyFilter($builder)
    {
        $end_time = Carbon::createFromFormat('Y-m-d H:i:s',request('end_time'));
        $start_time = Carbon::createFromFormat('Y-m-d H:i:s',request('start_time'));

        return $builder->where('start_time','<',$end_time)
            ->where('end_time','>=',$end_time)
            ->where( 'venue',request('venue'))

            ->orWhere('start_time', '>=', $start_time)
            ->where('end_time','<=',$end_time)
            ->where( 'venue',request('venue'))

            ->orWhere('start_time', '<', $end_time)
            ->where('end_time','<=',$end_time)
            ->where( 'venue',request('venue'));
    }
}
