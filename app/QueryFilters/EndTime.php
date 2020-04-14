<?php


namespace App\QueryFilters;


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
        return $builder->where([
            'end_time'  =>request('end_time'),
            'case_id'   =>request('case_id')
        ]);
    }
}
