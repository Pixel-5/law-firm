<?php


namespace App\QueryFilters;


class EndTime extends BaseFilter
{

    public function applyFilter($builder)
    {
        return $builder->where([
            'end_time'  =>request('end_time'),
            'case_id'   =>request('case_id')
        ]);
    }
}
