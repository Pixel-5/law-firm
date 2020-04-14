<?php


namespace App\QueryFilters;


class StartTime extends BaseFilter
{

    public function applyFilter($builder)
    {
        return $builder->where([
            'start_time'=>request('start_time'),
            'case_id'   =>request('case_id')
        ]);
    }
}
