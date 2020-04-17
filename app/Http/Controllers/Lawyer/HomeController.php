<?php

namespace App\Http\Controllers\Lawyer;

use App\Facade\CaseRepository;
use App\Http\Controllers\Controller;

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
            if ($case->schedule && $case->schedule->count() > 0){
                $schedule = $case->schedule;
                $events[] = [
                    'title'   => $schedule->notes . "\r\n"
                        .'Case No: '. $case->number,
                    'start'   => $schedule->getOriginal('start_time'),
                    'end'     => $schedule->end_time,
                    'venue'   => $schedule->venue,
                    'case'    => $case->number,
                    'client'  => $case->file->name . ' ' . $case->file->surname,
                    'url'   => route('lawyer.schedule.edit', $schedule->id),
                ];
            }
        }

//        dd($events);
        return view('lawyer.schedule-cases',compact('events'));
    }
}
