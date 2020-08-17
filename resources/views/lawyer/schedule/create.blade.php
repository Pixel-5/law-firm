@extends('layouts.default')
@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a @php
                           $isLawyer =  auth()->user()->roles->first()->title === 'Lawyer'
                       @endphp
                       href="{{  route($isLawyer? 'lawyer.dashboard': 'admin.dashboard') }}">Home
                    </a>
                </li>
                @if(auth()->user()->roles->first()->title === 'Lawyer')
                <li class="breadcrumb-item"><a href="{{ route('lawyer.schedule') }}">My Schedule</a></li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">Create Schedule</li>
                <li class="offset-11 d-sm-block" style="height: 10px;margin-top: -30px;">
                    <a href="{{ url()->previous() }}" title="Back">
                        <i class="fa fa-2x fa-chevron-circle-left"></i>
                    </a>
                </li>
            </ol>
        </nav>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-12  col-lg-12 col-sm-6 offset-0">
                <div class="card">
                    <div class="card-header">{{ trans('global.case') }} {{ trans('global.schedule') }}
                    </div>

                    <div class="card-body">

                        <form action="{{  route(isset($case) ? 'admin.schedule.store': 'lawyer.schedule.store')}}"
                              method="POST" id="form">
                            @csrf
                            @honeypot
                            @if(isset($case))
                                <div class="form-group">
                                    <label for="case_number">Case Number</label>
                                    <input type="text" id="case_number" class="form-control"
                                           value="{{ $case->number }}" readonly>

                                    <input type="hidden" id="case_id" name="case_id" class="form-control"
                                           value="{{ $case->id }}">
                                </div>
                                <div class="form-group">
                                    <label for="lawyer">Lawyer</label>
                                    <input type="text" id="lawyer" class="form-control"
                                           value="{{ $case->user->name }}" readonly>
                                </div>
                            @else
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label for="case_id">Case No</label>
                                    <select id="case_id" class="form-control" name="case_id">
                                        @php
                                            $hasNoSchedules = false;
                                        @endphp
                                        @foreach ($myCases as $case)
                                            @if ($case->schedule === null)
                                                @php
                                                    $hasNoSchedules = true;
                                                @endphp
                                                <option value="{{ $case->id }}" class="collapse-item">
                                                    {{ $case->number }}
                                                </option>
                                            @endif
                                        @endforeach
                                        @if (!$hasNoSchedules)
                                            <option class="collapse-item" readonly="true" >
                                                No case to schedule at the moment
                                            </option>
                                        @endif
                                    </select>
                                    @if($errors->has('case_id'))
                                        <em class="invalid-feedback" >
                                            {{ $errors->first('case_id') }}
                                        </em>
                                    @endif
                                </div>
                            @endif
                            <div class="form-group {{ $errors->has('venue') ? 'has-error' : '' }}">
                                <label for="venue">Venue</label>
                                <select id="venue" class="form-control venue" required name="venue"
                                        {{ isset($hasNoSchedules)? !$hasNoSchedules? 'disabled':'':'' }}>
                                    <option>Choose Location...</option>
                                    <option>Molepolole Magistrate</option>
                                    <option>Broadhurst Magistrate</option>
                                    <option>Ext 10 Magistrate</option>
                                    <option>High Court</option>
                                    <option>Lobatse Magistrate</option>
                                </select>
                                @if($errors->has('venue'))
                                    <em class="invalid-feedback" >
                                        {{ $errors->first('venue') }}
                                    </em>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('notes') ? 'has-error' : '' }}">
                                <label for="notes">Notes</label>
                                <textarea type="text" id="notes" name="notes" class="form-control"
                                  {{ isset($hasNoSchedules)? !$hasNoSchedules? 'disabled':'':'' }}>

                            </textarea>
                            </div>
                            <div class="form-group {{ $errors->has('start_time') ? 'has-error' : '' }}">
                                <label for="start_time">{{ trans('cruds.event.fields.start_time') }}*</label>
                                <input type="text" id="start_time" name="start_time" class="form-control datetime"
                                       value="{{ old('start_time', isset($event) ? $event->start_time : '') }}"
                                       required {{ isset($hasNoSchedules)? !$hasNoSchedules? 'disabled':'':'' }}>
                                @if($errors->has('start_time'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('start_time') }}
                                    </em>
                                @endif
                                <em class="invalid-feedback" id="start_time_errors"></em>
                                <p class="helper-block">
                                    {{ trans('cruds.event.fields.start_time_helper') }}
                                </p>
                            </div>
                            <div class="form-group {{ $errors->has('end_time') ? 'has-error' : '' }}">
                                <label for="end_time">{{ trans('cruds.event.fields.end_time') }}*</label>
                                <input type="text" id="end_time" name="end_time" class="form-control datetime"
                                       value="{{ old('end_time', isset($event) ? $event->end_time : '') }}"
                                       required {{ isset($hasNoSchedules)? !$hasNoSchedules? 'disabled':'':'' }}>
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
                            <div>
                                <input class="btn {{ isset($hasNoSchedules)? !$hasNoSchedules? 'btn-secondary':'btn-primary':'btn-primary' }} " type="submit"
                                       value="{{ trans('global.save') }}" {{ isset($hasNoSchedules)? !$hasNoSchedules? 'disabled':'':'' }}>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-scripts')
    <script type="application/javascript">

        $(document).ready(function () {
            let url = '{{ route('check-schedule') }}';
            let token = $('input[name="_token"]').val();
            let start_time = $('#start_time').val();
            let end_time = $('#end_time').val();
            let venue = $("#venue option:selected").text();
            let case_id = '{{ isset($case)? $case->id : $schedule->case->id }}';

            $("select.venue").change(function () {
                venue = $(this).children("option:selected").val();
                if ((start_time !== '') && (end_time !== '')){
                    checkSchedule(start_time, end_time, venue, url, token,case_id);
                }
            });

            $("#start_time").on("dp.change", function () {
                start_time = $(this).val();
                $("#end_time").val(start_time);

                if ((start_time !== null) && new Date(start_time) < new Date()) {
                    $("#start_time_errors").text("start date time  cannot be past date time");
                    $("#start_time_errors").css({'display': 'block'});
                    $('#form').attr('onsubmit', 'return false;');
                }
                else if ((end_time !== null) && new Date(start_time) > new Date(end_time)) {
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

                if ((end_time !== null) && new Date(end_time) < new Date()) {
                    $("#end_time_errors").text("start date time  cannot be past date time");
                    $("#end_time_errors").css({'display': 'block'});
                    $('#form').attr('onsubmit', 'return false;');

                }else{
                    $("#end_time_errors").text("");
                    $("#end_time_errors").css({'display': 'none'});
                    checkSchedule(start_time, end_time, venue, url, token,case_id);
                }
            });

        });
        function checkSchedule(start_time, end_time, venue, url, token,case_id) {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    '_token' : token,
                    'honeypot':'check_schedule',
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
    </script>
@endsection
