@extends('layouts.default')
@section('custom-links')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link rel='stylesheet' href='{{ asset('css/fullcalendar.css') }}' />
@endsection
@section('breadcrumb')
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
                <li class="breadcrumb-item active" aria-current="page">Case Schedule</li>
                <li class="offset-11 d-sm-block" style="height: 10px;margin-top: -30px;">
                    <a href="{{ url()->previous() }}" title="Back">
                        <i class="fa fa-2x fa-chevron-circle-left"></i>
                    </a>
                </li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-12 mb-4 offset-0">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-scripts')
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script src="https://unpkg.com/@fullcalendar/core@4.4.0/main.min.js"></script>
<script src="https://unpkg.com/@fullcalendar/daygrid@4.4.0/main.min.js"></script>
<script src="https://unpkg.com/@fullcalendar/timegrid@4.4.0/main.min.js"></script>
<script src="https://unpkg.com/@fullcalendar/list@4.4.0/main.min.js"></script>
<script src="https://unpkg.com/@fullcalendar/bootstrap@4.4.0/main.min.js"></script>

<script>
    $(document).ready(function () {
        // page is now ready, initialize the calendar...
        let events= {!! json_encode($events) !!};
        let calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'dayGrid', 'timeGrid', 'list', 'bootstrap' ],
            timeZone: 'UTC',
            defaultView: 'listMonth',
            themeSystem: 'bootstrap',
            header: {
                left: 'prevYear,prev,next,nextYear today, addEventButton',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            businessHours: [ // specify an array instead
                {
                    daysOfWeek: [ 1, 2, 3 ], // Monday, Tuesday, Wednesday
                    startTime: '08:00', // 8am
                    endTime: '18:00' // 6pm
                },
                {
                    daysOfWeek: [ 4, 5 ], // Thursday, Friday
                    startTime: '10:00', // 10am
                    endTime: '16:00' // 4pm
                }
            ],
            customButtons: {
                addEventButton: {
                    text: 'Schedule',
                    click: function() {
                        window.location.href='{{ route("lawyer.schedule.create") }}';
                    }
                }
            },
            weekNumbers: false,
            weekends: false,
            contentHeight: 400,
            eventLimit: true, // allow "more" link when too many events
            events: events
        });

        calendar.render();
    });
</script>
@endsection
