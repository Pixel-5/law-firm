@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col col-md-10  col-lg-10 col-sm-6 offset-0 ml-5">
            <div class="card">
                <div class="card-header">{{ trans('global.case') }} {{ trans('global.schedule') }}
                </div>

                <div class="card-body">

                    <form action="{{  route(isset($case) ? 'admin.schedule.store': 'lawyer.schedule.store')}}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($case))
                            <div class="form-group">
                                <label for="case_number">Case Number</label>
                                <input type="text" id="case_number" class="form-control"
                                       value="{{ $case->number }}" readonly>

                                <input type="hidden" id="case_id" name="case_id" class="form-control"
                                       value="{{ $case->id }}">
                            </div>
                            <div class="form-group">
                                <label for="case_number">Lawyer</label>
                                <input type="text" id="case_number" class="form-control"
                                       value="{{ $case->user->name }}" readonly>
                            </div>
                            @else
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="inputState">Case</label>
                                <select id="inputState" class="form-control">
                                    <option selected>Choose case...</option>
                                    <option>Case ASB-39-1</option>
                                    <option>Case BSC-40-2</option>
                                    <option>Case DSB-54-3</option>
                                    <option>Case ASB-90-11</option>

                                </select>
                            </div>
                            @endif
                        <div class="form-group {{ $errors->has('venue') ? 'has-error' : '' }}">
                            <label for="case_number">Venue</label>
                            <input type="text" id="venue" class="form-control" name="venue" required>
                        </div>
                        <div class="form-group {{ $errors->has('venue') ? 'has-error' : '' }}">
                            <label for="case_number">Notes</label>
                            <textarea type="text" id="notes" name="notes" class="form-control">

                            </textarea>
                        </div>
                        <div class="form-group {{ $errors->has('start_time') ? 'has-error' : '' }}">
                            <label for="start_time">{{ trans('cruds.event.fields.start_time') }}*</label>
                            <input type="text" id="start_time" name="start_time" class="form-control datetime"
                                   value="{{ old('start_time', isset($event) ? $event->start_time : '') }}" required>
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
                            <label for="end_time">{{ trans('cruds.event.fields.end_time') }}*</label>
                            <input type="text" id="end_time" name="end_time" class="form-control datetime"
                                   value="{{ old('end_time', isset($event) ? $event->end_time : '') }}" required>
                            @if($errors->has('end_time'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('end_time') }}
                                </em>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.event.fields.end_time_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('recurrence') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.event.fields.recurrence') }} </label>
                            @foreach(App\Schedule::RECURRENCE_RADIO as $key => $label)
                                <div>
                                    <input id="recurrence_{{ $key }}" name="recurrence" type="radio" value="{{ $key }}"
                                           {{ old('recurrence', 'none') === (string)$key ? 'checked' : '' }} required>
                                    <label for="recurrence_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('recurrence'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('recurrence') }}
                                </em>
                            @endif
                        </div>
                        <div>
                            <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
