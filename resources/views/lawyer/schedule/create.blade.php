@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col col-md-10  col-lg-10 col-sm-6 offset-0 ml-5">
            <div class="card">
                <div class="card-header">{{ trans('global.case') }} {{ trans('global.schedule') }}
                </div>

                <div class="card-body">

                    <form action="{{  route(isset($case) ? 'admin.schedule.store': 'lawyer.schedule.store')}}"
                          method="POST" enctype="multipart/form-data" id="form">
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
                            <em class="invalid-feedback" id="start_time_errors"></em>
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
                            <em class="invalid-feedback" id="end_time_errors"></em>
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
@section('scripts')
    <script type="application/javascript">

        $(document).ready(function () {
            let url = '{{ action('Lawyer\ScheduleController@checkSchedule') }}';
            let case_id = '{{ isset($case)? $case->id : '' }}';
            let token =  $('input[name="_token"]').val();
            let start_time = $("#start_time").val();
            let end_time = $("#end_time").val();

            $("#start_time").on("dp.change", function() {
                start_time = $(this).val();

                if(new Date(start_time) > new Date(end_time)){
                    $("#start_time_errors").text("start date time  cannot be greater than end date time");
                    $("#start_time_errors").css({'display':'block'});
                    $('#form').attr('onsubmit','return false;');
                }else{
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            '_token' : token,
                            'case_id': case_id,
                            'start_time': start_time
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response){
                            if(response.status){
                                $("#start_time_errors").text("Schedule for this date already exists");
                                $("#start_time_errors").css({'display':'block'});
                                $('#form').attr('onsubmit','return false;');
                            }else{
                                $("#start_time_errors").text("");
                                $("#start_time_errors").css({'display':'none'});
                                $('#form').attr('onsubmit','return true;');
                            }

                        },
                        error: function (response) {
                        }
                    })
                }

            });

            $("#end_time").on("dp.change", function() {
                end_time = $(this).val();

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        '_token' : token,
                        'case_id': case_id,
                        'end_time': end_time
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
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
                    }
                })
            });

        });
    </script>
@endsection
