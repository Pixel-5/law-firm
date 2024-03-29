<?php

namespace App\Http\Controllers\Lawyer;

use App\Facade\ClientRepository;
use App\Facade\ScheduleRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{

    public function index()
    {
        return view('lawyer.dashboard');
    }

    public function myCases()
    {
        return view('lawyer.assigned-cases');
    }

    public function pendingCases()
    {
        return view('lawyer.pending-cases');
    }

    public function mySchedule()
    {
        $events = [];
        $myCases = ScheduleRepository::mySchedule();
        foreach ($myCases as $schedule) {
            $events[] = [
                'title'   => class_basename($schedule->scheduleable) .' No: '. $schedule->scheduleable->number ,
                'start'   => $schedule->start_time,
                'end'     => $schedule->end_time,
                'venue'   => $schedule->venue,
                'client'  => $schedule->scheduleable->id . ' ' . $schedule->scheduleable->client->clientable->surname,
                'url'   => route('lawyer.schedule.show', $schedule->id),
            ];
        }
        return view('lawyer.schedule-cases',compact('events'));
    }

    public function chart(): JsonResponse
    {
        $data = ClientRepository::getMyChartData();
        return response()->json($data);
    }
}
