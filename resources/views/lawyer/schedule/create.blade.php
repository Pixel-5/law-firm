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
                @else
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.show',1) }}">Schedule</a></li>
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
    @if($errors->any())
      <div class="container-fluid">
          <div class="alert alert-danger alert-dismissible ">
              {!! implode('', $errors->all('<div>:message</div>')) !!}
          </div>
      </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-12  col-lg-12 col-sm-6 offset-0">
                <div class="card">
                    <div class="card-header">{{ trans('global.schedule') . ' Details' }}
                    </div>

                    <div class="card-body">

                        <form action="{{  route(isset($case) ? 'admin.schedule.store': 'lawyer.schedule.store')}}"
                              method="POST" id="form">
                            @csrf
                            @honeypot
                            <input type="hidden" id="lawyer" class="form-control" name="attorney_id"
                                   value="{{ isset($case)? $case->user->name : \Illuminate\Support\Facades\Auth::user()->id }}" >
                            @if(isset($case))
                                <div class="form-group">
                                    <label for="lawyer">Lawyer</label>
                                    <input type="text" id="lawyer" class="form-control"
                                           value="{{ $case->user->name }}" readonly>

                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label class="radio-inline">
                                            <input type="radio" name="scheduleable_type" value="litigation">
                                            {{ class_basename($case) }}
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="case_number">
                                        {{ isset($case) ?class_basename($case) . 'Number' : '' }}
                                    </label>
                                    <input type="text" id="scheduleable_id" class="form-control"
                                           value="{{ $case->number }}" readonly>

                                    <input type="hidden" id="scheduleable_id" name="scheduleable_id" class="form-control"
                                           value="{{ $case->id }}">
                                </div>
                            @else
                                <div class="form-row ml-1">
                                    <label for="category" class="alert alert-secondary container">Schedule Reason</label>
                                </div>
                                <div class="form-row">
                                    <div  class="form-group col-4 {{ $errors->has('schedule_appointment') ? 'has-error' : '' }}">
                                        <label class="radio-inline">
                                            <input type="radio" name="schedule_appointment" value="client"
                                                   @if(old('schedule_appointment') != null)
                                                   checked="{{ old('schedule_appointment') == 'client' }}"
                                                @endif>
                                            Client Appointment
                                        </label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="radio-inline">
                                            <input type="radio" name="schedule_appointment" value="court"
                                                   @if(old('schedule_appointment') != null)
                                                   checked="{{ old('schedule_appointment') == 'court' }}"
                                                @endif>
                                            Court Appointment
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group   {{ old('schedule_appointment') == 'court'? 'd-block': 'hidden' }}"
                                     id="court_venue"> <label for="venue" id="venueLabel" class="alert {{ $errors->has('venue') ? 'alert-danger' : 'alert-secondary ' }} container"> Venue</label>
                                    <select id="court_ap_venue" class="form-control" name="venue">
                                        <option selected value="">Choose Location...</option>
                                        <option>Molepolole Magistrate</option>
                                        <option>Broadhurst Magistrate</option>
                                        <option>Ext 10 Magistrate</option>
                                        <option>High Court</option>
                                        <option>Lobatse Magistrate</option>
                                    </select>
                                    @error('venue')
                                    <em class="invalid-feedback d-block" id="venue_error">{{ $message }}</em>
                                    @enderror
                                </div>
                                <div class="form-group {{ $errors->has('venue') ? 'has-error' : '' }} {{ old('schedule_appointment') == 'client'? 'd-block': 'hidden' }}"
                                     id="client_venue">
                                    <label for="client_venue" class="alert alert-secondary container">Venue</label>
                                    <input type="text" id="client_venue_input"  name="venue" class="form-control"
                                           value="{{ old('schedule_appointment') == 'client'? old('venue') : '' }}">
                                    @error('client_ap_venue')
                                    <em class="invalid-feedback">{{ $message }}</em>
                                    @enderror
                                </div>
                                <div class="form-row ml-1">
                                    <label for="category" class="alert alert-secondary container">Schedule Category</label>
                                </div>
                                <div class="form-row {{ $errors->has('scheduleable_type') ? 'has-error' : '' }}">
                                    <div class="form-group col-md-4">
                                        <label class="radio-inline">
                                            <input type="radio" name="scheduleable_type" value="litigation"
                                                   @if(old('scheduleable_type') != null)
                                                   checked="{{ old('scheduleable_type') == 'litigation' }}"
                                                @endif>
                                            Litigation
                                        </label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="radio-inline">
                                            <input type="radio" name="scheduleable_type" value="conveyancing"
                                                   @if(old('scheduleable_type') != null)
                                                   checked="{{ old('scheduleable_type') == 'conveyancing' }}"
                                                    @endif>
                                            Conveyancing
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group hidden" id="numberField">
                                    <label for="number" id="numberLabel" class="alert alert-secondary container">Number</label>
                                    <select id="number" class="form-control" name="scheduleable_id" required>
                                    </select>
                                    @if($errors->has('scheduleable_id'))
                                        <em class="invalid-feedback d-block" >
                                            {{ $errors->first('scheduleable_id') }}
                                        </em>
                                    @endif
                                </div>

                            @endif

                            <div class="form-group {{ $errors->has('notes') ? 'has-error' : '' }}">
                                <label for="notes" class="alert alert-secondary container">Notes</label>
                                <textarea type="text" id="notes" name="notes" class="form-control"
                                  {{ isset($hasNoSchedules)? !$hasNoSchedules? 'disabled':'':'' }}></textarea>
                            </div>
                            <div class="form-group {{ $errors->has('start_time') ? 'has-error' : '' }}">
                                <label for="start_time" class="alert alert-secondary container">{{ trans('cruds.event.fields.start_time') }}*</label>
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
                                <label for="end_time" class="alert alert-secondary container">{{ trans('cruds.event.fields.end_time') }}*</label>
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

            @if( old('scheduleable_type') != null)
                @if($errors->has('scheduleable_id'))
                    $('#numberLabel').removeClass('alert-secondary');
                    $('#numberLabel').addClass('alert-danger');
                @endif

                @if(old('scheduleable_type') == 'litigation')
                    $('#number').find('option').remove();
                    $('#numberField').removeClass('hidden');

                    $('#numberLabel').html('Litigation Number');
                    @foreach($myAssignedLitigationClient as $litigation)
            @if($litigation->schedule === null)
            @if($litigation->id == old('scheduleable_id'))
            $('#number').append(`<option value="{{ $litigation->id }}" selected>{{ $litigation->number }}</option>`);
            @else
            $('#number').append(`<option value="{{ $litigation->id }}">{{ $litigation->number }}</option>`);
            @endif
            @endif
            @endforeach
                    @else
                    $('#number').find('option').remove();
                    $('#numberField').removeClass('hidden');
                    $('#numberLabel').html('Conveyancing Number');
                    $('#number').append(`<option disabled selected>Select Conveyancing Number</option>`);
                    @foreach($myAssignedConveyancingClient->conveyancing as $conveyancing)
            @if($conveyancing->schedule === null)
            @if($conveyancing->id == old('scheduleable_id'))
            $('#number').append(`<option value="{{ $conveyancing->id }}" selected>{{ $conveyancing->number }}</option>`);
            @else
            $('#number').append(`<option value="{{ $conveyancing->id }}">{{ $conveyancing->number }}</option>`);
            @endif
            @endif
            @endforeach
                @endif
            @endif
            $('input[type=radio][name=scheduleable_type]').change(function() {
                var conveyancing;
                var litigation;
                var schedule_appointment
                if (this.value === 'litigation') {
                    $('#number').find('option').remove();
                    $('#numberField').removeClass('hidden');
                    $('#numberLabel').html('Litigation Number');
                    $('#number').append(`<option value="" selected>Select Litigation Number</option>`);
                    schedule_appointment = $('input[type=radio][name=schedule_appointment]:checked').val();
                    console.log(schedule_appointment+' schedule');
                    @foreach($myAssignedClients as $myAssignedClient)
                        @foreach($myAssignedClient->litigation as $litigation)
                            @if($litigation->schedule !== null)
                            litigation = '{{ $litigation->schedule->schedule_appointment }}';
                            console.log(litigation);
                            if (litigation !== schedule_appointment){
                                $('#number').append(`<option value="{{ $litigation->id }}">{{ $litigation->number }}</option>`);
                            }
                            @else
                                $('#number').append(`<option value="{{ $litigation->id }}">{{ $litigation->number }}</option>`);
                             @endif
                        @endforeach
                    @endforeach
                }
                else if (this.value === 'conveyancing') {
                    $('#number').find('option').remove();
                    $('#numberField').removeClass('hidden');
                    $('#numberLabel').html('Conveyancing Number');
                    $('#number').append(`<option value="" selected>Select Conveyancing Number</option>`);
                    schedule_appointment = $('input[type=radio][name=schedule_appointment]:checked').val();
                    @foreach($myAssignedClients as $myAssignedClient)
                        @foreach($myAssignedClient->conveyancing as $conveyancing)
                            @if($conveyancing->schedule !== null)
                                conveyancing = '{{ $conveyancing->schedule->schedule_appointment }}';
                                if (conveyancing != schedule_appointment){
                                    $('#number').append(`<option value="{{ $conveyancing->id }}">{{ $conveyancing->number }}</option>`);
                                }
                            @else
                            $('#number').append(`<option value="{{ $conveyancing->id }}">{{ $conveyancing->number }}</option>`);
                            @endif
                        @endforeach
                    @endforeach
                }
            });

            $('input[type=radio][name=schedule_appointment]').change(function() {
                $('input[type=radio][name=scheduleable_type]').prop('checked', false);
                if (this.value === 'client') {
                    $('#court_venue').addClass('hidden');
                    $('#court_ap_venue').prop('required', false);
                    $('#court_ap_venue').prop('disabled', true);

                    $('#client_venue').removeClass('hidden');
                    $('#client_venue_input').prop('disabled', false);
                    $('#client_venue_input').prop('required', true);
                }
                else if (this.value === 'court') {
                    $('#client_venue').addClass('hidden');
                    $('#client_venue_input').prop('disabled', true);
                    $('#client_venue_input').prop('required', false);

                    $('#court_venue').removeClass('hidden');
                    $('#court_ap_venue').prop('required', true);
                    $('#court_ap_venue').prop('disabled', false);
                }
            });

            let url = '{{ route('check-schedule') }}';
            let token = $('input[name="_token"]').val();
            let start_time = $('#start_time').val();
            let end_time = $('#end_time').val();
            let venue = $("#venue option:selected").text();

            $("select.venue").change(function () {
                venue = $(this).children("option:selected").val();
                if ((start_time !== '') && (end_time !== '')){
                    checkSchedule(start_time, end_time, venue, url, token);
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
                    checkSchedule(start_time, end_time, venue, url, token);
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
                    checkSchedule(start_time, end_time, venue, url, token);
                }
            });

        });
        function checkSchedule(start_time, end_time, venue, url, token) {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    '_token' : token,
                    'honeypot':'check_schedule',
                    'start_time': start_time,
                    'end_time': end_time,
                    'venue': venue,
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
