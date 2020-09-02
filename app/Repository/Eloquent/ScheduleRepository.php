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
use Illuminate\Support\Facades\Auth;

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

    private function getCase($id)
    {
        $case = CaseRepository::showCase($id);
        $case = $case->load('user');
        return $case;
    }
    public function createSchedule($request)
    {

        return $this->create([
            'schedule_appointment'  => $request->schedule_appointment,
            'attorney_id' => $request->attorney_id,
            'scheduleable_id' => $request->scheduleable_id,
            'scheduleable_type' => $request->scheduleable_type == 'litigation'? 'App\Litigation':'App\Conveyancing',
            'notes' => $request->notes,
            'venue' =>$request->venue,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time
        ]);
    }

    public function deleteSchedule($id)
    {

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
        $schedule = $schedule->load(['conveyancing','litigation']);
        return $schedule;
    }

    public function mySchedule()
    {
        $schedule = $this->model->where('attorney_id',Auth::user()->id)->get();
        $schedule = $schedule->load(['scheduleable']);
        return $schedule;
    }

    public function getSchedule($id)
    {
        $schedule = $this->find($id);
        $schedule = $schedule->load(['scheduleable.client.clientable',]);
        return $schedule;
    }
}
