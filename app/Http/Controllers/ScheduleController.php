<?php

namespace App\Http\Controllers;

use App\Facade\ScheduleRepository;

class ScheduleController extends Controller
{
    public function __invoke()
    {
        return ScheduleRepository::checkSchedule();
    }
}
