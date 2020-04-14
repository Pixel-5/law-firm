<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet" />

    <link rel='stylesheet' href='{{ asset('css/fullcalendar.css') }}' />

    <title>Lawyer Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('js/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
@include("lawyer.side-nav-bar")
<!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
        @include("lawyer.top-nav-bar")
        <!-- End of Topbar -->
            <div class="container-fluid">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('lawyer.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Case Schedule</li>
                    </ol>
                </nav>
            </div>
            <!-- Begin Page Content -->
            <div class="container-fluid">


{{--                @can('event_create')--}}
{{--                    <div style="margin-bottom: 10px;" class="row">--}}
{{--                        <div class="col-lg-11">--}}
{{--                            <a class="btn btn-success offset-12" href="{{ route("lawyer.events.create") }}">--}}
{{--                                {{ trans('global.schedule') }} {{ trans('global.case') }}--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endcan--}}
                <!-- Content Row -->
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

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
    @include("footer")
    <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById
                ('frm-logout').submit();">
                    Logout
                </a>
                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
</div>

@include("layouts.scripts")
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

        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'dayGrid', 'timeGrid', 'list', 'bootstrap' ],
            timeZone: 'UTC',
            defaultView: 'dayGridMonth',
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
                    text: 'Schedule Case',
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
</body>

</html>
