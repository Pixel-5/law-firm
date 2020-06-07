<?php

namespace App\Repository\Eloquent;

use App\QueryFilters\CaseId;
use App\QueryFilters\EndTime;
use App\QueryFilters\StartTime;
use App\QueryFilters\Venue;
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


    public function update(int $id, array $attributes): Bool
    {
        return $this->find($id)->update($attributes);
    }

    public function getSchedule($id)
    {
        $schedule = $this->find($id);
        $schedule = $schedule->load(['case']);
        return $schedule;
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

    //check given lawyer schedule if exists
    public function checkSchedule()
    {
        $pipeline = app(Pipeline::class)
            ->send($this->model->query())
            ->through([
                StartTime::class,
                EndTime::class
            ])
            ->thenReturn();
        if ($pipeline && $pipeline->first() !== null) {
            return ['status' => $pipeline->first()->exists];
        }
        return ['status' => false];
    }

    public function schedules()
    {
        $schedule = $this->model->all();
        $schedule = $schedule->load(['case','case.file','case.user']);
        return $schedule;
    }
}
