<?php

namespace App\Http\Controllers\Admin;

use App\Facade\CaseRepository;
use App\Facade\ScheduleRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        abort_if(Gate::denies('schedule_access'), Response::HTTP_FORBIDDEN,
            'You do not have permissions to access schedules');

        return view('admin.lawyer.schedule-case');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreScheduleRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreScheduleRequest $request)
    {
        $schedule = ScheduleRepository::createSchedule($request->all());
        return redirect()->route('admin.schedule.index')
            ->with(empty($schedule))?
                ['status'=> 'Failed to update schedule'. 'Date & Time slot from '.
                    $request->start_time . ' to ' . $request->end_time .
                    ' is unavailable. Please check another available slot'] :
                ['status'=> 'Successfully scheduled a case'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function show($id)
    {
        abort_if(Gate::denies('schedule_create'), Response::HTTP_FORBIDDEN,
            'You do not have permissions to create schedule');

        $case = CaseRepository::showCase($id);
        return view('lawyer.schedule.create',compact('case'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function edit($id)
    {
        abort_if(Gate::denies('schedule_edit'), Response::HTTP_FORBIDDEN,
            'You do not have permissions to edit schedule');

       $schedule = ScheduleRepository::getSchedule($id);
       $isAdmin = true;
        return view('lawyer.schedule.edit',compact(['schedule','isAdmin']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateScheduleRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateScheduleRequest $request, $id)
    {
        return redirect()->route('admin.schedule.index')->with(empty(
            ScheduleRepository::updateSchedule($id,$request))?
            ['fail'=> 'Failed to update schedule'. 'Date & Time slot from '.
                $request->start_time . ' to ' . $request->end_time .
                ' is unavailable. Please check another available slot'] :
            ["status" => "Successfully updated case schedule"]);
    }
}
