<?php

namespace App\Repository\Eloquent;

use App\QueryFilters\EndTime;
use App\QueryFilters\StartTime;
use App\Repository\ScheduleRepositoryInterface;
use App\Schedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;
use App\Facade\CaseRepository;

class ScheduleRepository extends AbstractBaseRepository implements ScheduleRepositoryInterface
{

    /**
     * @inheritDoc
     */

    public function __construct(Schedule $model)
    {
        parent::__construct($model);
    }


    public function update(int $id, array $attributes): Model
    {
        $schedule = $this->find($id);
        $schedule->update($attributes);
        return $schedule;
    }

    public function getSchedule($id)
    {
        return $this->find($id);
    }

    private function getCase($id)
    {
        $case = CaseRepository::showCase($id);
        $case = $case->load('user');
        return $case;
    }
    public function createSchedule(array $attributes)
    {
        return $this->create($attributes);
    }

    public function deleteSchedule($id)
    {
        // TODO: Implement deleteSchedule() method.
    }

    public function updateSchedule($id, $request)
    {
        return $this->update($id,$request->all());
    }

    public function checkSchedule()
    {
        $pipeline = app(Pipeline::class)
            ->send($this->model->query())
            ->through(array(
                StartTime::class,
                EndTime::class
            ))
            ->thenReturn();

        if ($pipeline->first() != null)
            return ['status' => $pipeline->first() != null? $pipeline->first()->exists : false];

        return ['status' => false];
    }

}