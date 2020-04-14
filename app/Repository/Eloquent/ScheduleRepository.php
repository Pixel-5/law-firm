<?php


namespace App\Repository\Eloquent;

use App\Repository\ScheduleRepositoryInterface;
use App\Schedule;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use \App\Facade\UserRepository;

class ScheduleRepository extends AbstractBaseRepository implements ScheduleRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function __construct(Schedule $model)
    {
        parent::__construct($model);
    }

    public function checkAvailableSlot($user_id, $start, $end)
    {
        $schedules = UserRepository::userSchedule($user_id)->userSchedule;
        $start = Carbon::createFromFormat(
            config('panel.date_format') . ' ' . config('panel.time_format'),
            $start)->format('Y-m-d H:i:s') ;
        $end =  Carbon::createFromFormat(
            config('panel.date_format') . ' ' . config('panel.time_format'),
            $end)->format('Y-m-d H:i:s') ;

        foreach ($schedules as $schedule){
            if ($start == $schedule->start_time && $end == $schedule->end_time)
                return false;
        }
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

    public function createSchedule(array $attributes)
    {
        $case = \App\Facade\CaseRepository::showCase($attributes->case_id);
        $case = $case->load('user');

        if ($this->checkAvailableSlot($case->user->id,$attributes->start_time, $attributes->end_time))
            return $this->create($attributes);
        return null;
    }

    public function deleteSchedule($id)
    {
        // TODO: Implement deleteSchedule() method.
    }

    public function updateSchedule($id, $request)
    {
        $case = \App\Facade\CaseRepository::showCase($id);
        $case = $case->load('user');

        if ($this->checkAvailableSlot($case->user->id,$request->start_time, $request->end_time))
            return $this->update($id,$request->all());

        return null;
    }

}
