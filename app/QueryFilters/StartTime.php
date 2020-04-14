<?php


namespace App\QueryFilters;


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
        return $builder->where([
            'start_time'=>request('start_time'),
            'case_id'   =>request('case_id')
        ]);
    }
}
