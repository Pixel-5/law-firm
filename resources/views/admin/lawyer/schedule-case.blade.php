@extends('layouts.default')
@section('custom-links')
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('breadcrumb')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cases</li>
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
    <!-- Content Row -->
    <div class="row">
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table hover table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th>File No</th>
                                <th>Case No</th>
                                <th>Lawyer</th>
                                <th>Schedule</th>
                                <th>Venue</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($scheduledCases as $case)
                            <tr>
                                <td>{{ $case->file->number }}</td>
                                <td>{{ $case->number }}</td>
                                <td>
                                    {{ $case->user !== null ? $case->user->name : '' }}
                                </td>
                                <td>
                                    {{ $case->schedule != null ? ' Start: '. $case->schedule->start_time : ''}}
                                    <br/>
                                     {{ $case->schedule != null ? 'End: ' . $case->schedule->end_time : ''}}
                                </td>
                                <td> {{ $case->schedule != null ? $case->schedule->venue : '' }}</td>
                                <td>
                                    @if($case->schedule != null)
                                    <a class="btn btn-outline-success btn-sm  text-center"
                                       href="{{ route('admin.schedule.edit', $case->schedule->id) }}" role="button" aria-haspopup="true"
                                       aria-expanded="false"><i class="fa fa-calendar-check">
                                        </i> Re-schedule</a>
                                        @else
                                        <a class="btn btn-outline-info btn-sm  text-center"
                                           href="{{ action('Admin\ScheduleController@show', $case->id) }}" role="button" aria-haspopup="true"
                                           aria-expanded="false"><i class="fa fa-calendar-plus">
                                            </i> Schedule case</a>
                                        @endif
                                </td>
                            </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
@endsection

@section('custom-scripts')
    <!-- Page level plugins -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/responsive.bootstrap4.min.js') }}"></script>

    <script type="application/javascript">
        $(document).ready(function() {
            let groupColumn = 0;
            $('#example').DataTable( {
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal( {
                            header: function ( row ) {
                                var data = row.data();
                                return 'Case Details for '+data[1];
                            }
                        } ),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                            tableClass: 'table'
                        } )
                    }
                },
                "columnDefs": [
                    { "visible": false, "targets": groupColumn }
                ],
                "displayLength":10,
            } );
        } );
    </script>
@endsection
