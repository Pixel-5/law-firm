<?php

namespace App\Http\Controllers\Lawyer;

use App\Facade\ScheduleRepository;
use App\Jobs\SendSmsNotifications;
use App\Schedule;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEventRequest;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use Gate;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ScheduleController extends Controller
{
    private $message = 'You do not have permission to';
    public function index()
    {
        abort_if(Gate::denies('schedule_access'), Response::HTTP_FORBIDDEN,
            $this->message.' access schedules');
        $schedules = Schedule::withCount('schedules')
            ->get();

        return view('lawyer.schedule.index', compact('schedules'));
    }

    public function create()
    {
        abort_if(Gate::denies('schedule_create'), Response::HTTP_FORBIDDEN,
            $this->message .' create this schedule');

        return view('lawyer.schedule.create');
    }

    public function store(StoreScheduleRequest $request)
    {
        $schedule = Schedule::create($request->all());
        SendSmsNotifications::dispatch($schedule);
        return redirect()->route('lawyer.schedule')->with('status', 'Successfully scheduled a case');
    }

    public function edit(Schedule $schedule)
    {
        abort_if(Gate::denies('schedule_edit'), Response::HTTP_FORBIDDEN,
            $this->message .' edit this schedule');

        $schedule->load('schedule')
            ->loadCount('schedules');

        return view('lawyer.schedule.edit', compact('schedule'));
    }

    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        $schedule->update($request->all());

        if (Auth::user()->roles)
        return redirect()->route('lawyer.schedule');
    }

    public function show(Schedule $schedule)
    {
        abort_if(Gate::denies('schedule_show'), Response::HTTP_FORBIDDEN,
            $this->message .' show this schedule');

        $schedule->load('schedule');

        return view('lawyer.schedule.show', compact('schedule'));
    }

    public function destroy(Schedule $schedule)
    {
        abort_if(Gate::denies('schedule_delete'), Response::HTTP_FORBIDDEN,
            $this->message .' delete this schedule');
        $schedule->delete();

        return redirect()->route('lawyer.schedule')->with('status', 'Successfully deleted a schedule');
    }

    public function massDestroy(MassDestroyEventRequest $request)
    {
        Schedule::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function checkSchedule()
    {
        return ScheduleRepository::checkSchedule();
    }
}
