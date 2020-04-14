@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.update') }} {{ trans('global.case') }} {{ trans('global.schedule') }}
    </div>

    <div class="card-body">
        <form action="{{  route(isset($isAdmin) ? 'admin.schedule.update' : 'lawyer.schedule.update', [$schedule->id]) }}"
            method="POST"
            enctype="multipart/form-data"
            @if($schedule->schedules_count || $schedule->schedule)
              onsubmit="return confirm('Do you want to apply these changes to all future recurring events, too?');"
            @endif
        >
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('venue') ? 'has-error' : '' }}">
                <label for="venue">Venue <span style="color: red;">*</span></label>
                <input type="text" id="venue" name="venue" class="form-control"
                       value="{{ old('name', isset($schedule) ? $schedule->venue : '') }}" required>
                @if($errors->has('venue'))
                    <em class="invalid-feedback">
                        {{ $errors->first('venue') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.event.fields.name_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('start_time') ? 'has-error' : '' }}">
                <label for="start_time">{{ trans('cruds.event.fields.start_time') }}
                    <span style="color: red;">*</span>
                </label>
                <input type="text" id="start_time" name="start_time" class="form-control datetime"
                       value="{{ old('start_time', isset($schedule) ? $schedule->start_time : '') }}" required>
                @if($errors->has('start_time'))
                    <em class="invalid-feedback">
                        {{ $errors->first('start_time') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.event.fields.start_time_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('end_time') ? 'has-error' : '' }}">
                <label for="end_time">{{ trans('cruds.event.fields.end_time') }}
                    <span style="color: red;">*</span>
                </label>
                <input type="text" id="end_time" name="end_time" class="form-control datetime"
                       value="{{ old('end_time', isset($schedule) ? $schedule->end_time : '') }}" required>
                @if($errors->has('end_time'))
                    <em class="invalid-feedback">
                        {{ $errors->first('end_time') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.event.fields.end_time_helper') }}
                </p>
            </div>

            @if(!$schedule->event && !$schedule->events_count)
                <div class="form-group {{ $errors->has('recurrence') ? 'has-error' : '' }}">
                    <label>{{ trans('cruds.event.fields.recurrence') }}
                        <span style="color: red;">*</span>
                    </label>
                    @foreach(App\Schedule::RECURRENCE_RADIO as $key => $label)
                        <div>
                            <input id="recurrence_{{ $key }}" name="recurrence" type="radio"
                                   value="{{ $key }}" {{ old('recurrence', (string) $schedule->recurrence) === (string) $key ? 'checked' : '' }}
                                   required>
                            <label for="recurrence_{{ $key }}">{{ $label }}</label>
                        </div>
                    @endforeach
                    @if($errors->has('recurrence'))
                        <em class="invalid-feedback">
                            {{ $errors->first('recurrence') }}
                        </em>
                    @endif
                </div>
            @else
                <input type="hidden" name="recurrence" value="{{ $schedule->recurrence }}">
            @endif
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection
