<?php


namespace App\Repository;


interface ScheduleRepositoryInterface
{
    public function getSchedule($id);

    public function createSchedule(array $attributes);

    public function updateSchedule($id, $attributes);

    public function deleteSchedule($id);
}
