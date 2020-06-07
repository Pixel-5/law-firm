@extends('layouts.default')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a @php
                       $isLawyer =  auth()->user()->roles->first()->title === 'Lawyer'
                   @endphp
                   href="{{  route($isLawyer? 'lawyer.dashboard': 'admin.dashboard') }}">Home
                </a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('lawyer.schedule') }}">
                   Schedule
                </a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
            <li class="offset-11 d-sm-block" style="height: 10px;margin-top: -30px;">
                <a href="{{ url()->previous() }}" title="Back">
                    <i class="fa fa-2x fa-chevron-circle-left"></i>
                </a>
            </li>
        </ol>
    </nav>
<div class="card">
    <div class="card-header">
        {{ trans('global.update') }} {{ trans('global.case') }} {{ trans('global.schedule') }}

    </div>

    <div class="card-body">
        <form action="{{  route(isset($isAdmin) ? 'admin.schedule.update' : 'lawyer.schedule.update',
            [$schedule->id]) }}" method="POST" enctype="multipart/form-data" id="form">
            @csrf
            @method('PUT')
            <div class="form-group ">
                <label for="case_id">Case No</label>
                <input type="text" id="case_id" class="form-control"
                       value="{{ isset($schedule) ? $schedule->case->number : '' }}" readonly>
            </div>
            <div class="form-group ">
                <label for="case_id">Client</label>
                <input type="text" id="case_id" class="form-control"
                       value="{{ isset($schedule) ? $schedule->case->file->name . ' '.
                                $schedule->case->file->surname : '' }}" readonly>
            </div>
            <div class="form-group {{ $errors->has('venue') ? 'has-error' : '' }}">
                <label for="venue">Venue <span style="color: red;">*</span></label>
                <select id="venue" class="form-control venue" name="venue">
                    <option>{{ old('name', isset($schedule) ? $schedule->venue : '') }}</option>
                    <option>Molepolole Magistrate</option>
                    <option>Broadhurst Magistrate</option>
                    <option>Ext 10 Magistrate</option>
                    <option>High Court</option>
                    <option>Lobatse Magistrate</option>
                </select>
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
                    <em class="invalid-feedback" >
                        {{ $errors->first('start_time') }}
                    </em>
                @endif
                <em id="start_time_errors" class="invalid-feedback"></em>
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
                <em class="invalid-feedback" id="end_time_errors"></em>
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
                <input class="btn btn-primary" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection
@section('custom-scripts')
    <script type="application/javascript">

        $(document).ready(function () {
            let url = '{{ action('Lawyer\ScheduleController@checkSchedule') }}';
            let token = $('input[name="_token"]').val();
            let start_time = $('#start_time').val();
            let end_time = $('#end_time').val();
            let venue = $("#venue option:selected").text();
            let case_id = '{{ isset($case)? $case->id : $schedule->case->id }}';


            $("select.venue").change(function () {
                venue = $(this).children("option:selected").val();

                checkSchedule(start_time, end_time, venue, url, token,case_id);
            });

            $("#start_time").on("dp.change", function () {
                start_time = $(this).val();

                if ((end_time != null) && new Date(start_time) > new Date(end_time)) {
                    $("#start_time_errors").text("start date time  cannot be greater than end date time");
                    $("#start_time_errors").css({'display': 'block'});
                    $('#form').attr('onsubmit', 'return false;');

                } else {
                    $("#start_time_errors").text("");
                    $("#start_time_errors").css({'display': 'none'});
                    checkSchedule(start_time, end_time, venue, url, token,case_id);
                }
            });

            $("#end_time").on("dp.change", function () {
                end_time = $(this).val();
                checkSchedule(start_time, end_time, venue, url, token,case_id);
            });

        });
        function checkSchedule(start_time, end_time, venue, url, token,case_id) {
            console.log(venue);
            console.log(case_id);
            console.log(start_time);
            console.log(end_time);

            if((start_time !== null) && new Date(start_time) > new Date(end_time)){

                $("#start_time_errors").text("start date time  cannot be greater than end date time");
                $("#start_time_errors").css({'display':'block'});
                $('#form').attr('onsubmit','return false;');

            }
            else if (start_time != null){

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        '_token' : token,
                        'start_time': start_time,
                        'end_time': end_time,
                        'venue': venue,
                        'case': case_id
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){

                        $("#start_time_errors").text("");
                        $("#start_time_errors").css({'display':'none'});
                        console.log(response.status);
                        if(response.status){

                            $("#end_time_errors").text("Schedule for this date already exists");
                            $("#end_time_errors").css({'display':'block'});
                            $('#form').attr('onsubmit','return false;');

                        }else{
                            $("#end_time_errors").text("");
                            $("#end_time_errors").css({'display':'none'});
                            $('#form').attr('onsubmit','return true;');
                        }

                    },
                    error: function (response) {
                        console.log(response);
                    }
                });
            }
        }
    </script>
@endsection
