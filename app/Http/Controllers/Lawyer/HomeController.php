<?php

namespace App\Http\Controllers\Lawyer;

use App\Facade\CaseRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

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
        $myCases = CaseRepository::myCases();
        foreach ($myCases as $case) {
            if ($case->schedule !=- null && !empty($case->schedule)){
                $schedule = $case->schedule;
                $events[] = [
                    'title'   => 'Case No: '. $case->number,
                    'start'   => $schedule->start_time,
                    'end'     => $schedule->end_time,
                    'venue'   => $schedule->venue,
                    'case'    => $case->number,
                    'client'  => $case->file->name . ' ' . $case->file->surname,
                    'url'   => route('lawyer.schedule.show', $schedule->id),
                ];
            }
        }
        return view('lawyer.schedule-cases',compact('events'));
    }

    public function chart(): JsonResponse
    {
        $data = CaseRepository::getMyChartData();
        return response()->json($data);
    }
}
