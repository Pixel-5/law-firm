<?php

namespace App\Http\Controllers\Lawyer;

use App\Schedule;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEventRequest;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('event_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $events = Schedule::withCount('events')
            ->get();

        return view('lawyer.events.index', compact('events'));
    }

    public function create()
    {
        abort_if(Gate::denies('event_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('lawyer.events.create');
    }

    public function store(StoreScheduleRequest $request)
    {
        Schedule::create($request->all());

        return redirect()->route('lawyer.schedule');
    }

    public function edit(Schedule $event)
    {
        abort_if(Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->load('event')
            ->loadCount('events');

        return view('lawyer.events.edit', compact('event'));
    }

    public function update(UpdateScheduleRequest $request, Schedule $event)
    {
        $event->update($request->all());

        return redirect()->route('lawyer.schedule');
    }

    public function show(Schedule $event)
    {
        abort_if(Gate::denies('event_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->load('event');

        return view('lawyer.events.show', compact('event'));
    }

    public function destroy(Schedule $event)
    {
        abort_if(Gate::denies('event_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->delete();

        return back();
    }

    public function massDestroy(MassDestroyEventRequest $request)
    {
        Schedule::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
