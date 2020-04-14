<?php


namespace App\Repository\Eloquent;

use App\Repository\ScheduleRepositoryInterface;
use App\Schedule;
use Illuminate\Database\Eloquent\Model;

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
}
