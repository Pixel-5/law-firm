@extends('layouts.default')
@section('custom-links')
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('breadcrumb')
    <!-- Page Heading -->
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('lawyer.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pending Cases</li>
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
    <!-- Begin Page Content -->
    <div class="row">
        <div class="container-fluid">

            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseLitigationCard" class="d-block card-header py-3" data-toggle="collapse" role="button"
                   aria-expanded="true" aria-controls="collapseLitigationCard">
                    <h6 class="m-0 font-weight-bold text-primary">Pending Litigation</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse hide" id="collapseLitigationCard">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table hover table-striped table-bordered nowrap" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Litigation No</th>
                                    <th>Client</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                    @inject('litigation','App\Repository\LitigationRepositoryInterface')
                                    @foreach ($litigation->getMyLitigation() as $case)
                                        @if ($case->schedule !== null)
                                        <tr>
                                            <td>{{ $case->number }}</td>
                                            <td>{{ $case->client->clientable->name }} {{$case->client->clientable->surname }}</td>
                                            <td>
                                                <span class="badge badge-info">{{ $case->status }}</span>
                                            </td>
                                            <td>
                                                <a class="btn btn-secondary btn-sm  text-center text-white" title="View Case"
                                                   href="{{ route('lawyer.litigation.show', $case->id ) }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a class="btn btn-primary btn-sm  text-center text-white" title="Schedule case"
                                                   href="{{ route('lawyer.schedule.create') }}">
                                                    <i class="fa fa-calendar"></i>
                                                </a>
                                                <a class="btn btn-info btn-sm  text-center text-white" title="Open file"
                                                   href="{{ route('admin.client.show', $case->client->clientable->id) }}">
                                                    <i class="fa fa-folder-open"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseConveyancingCard" class="d-block card-header py-3" data-toggle="collapse"
                   role="button" aria-expanded="true" aria-controls="collapseConveyancingCard">
                    <h6 class="m-0 font-weight-bold text-primary">Pending Conveyancing</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse hide" id="collapseConveyancingCard">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example2" class="table hover table-striped table-bordered nowrap" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Case No</th>
                                    <th>Client</th>
                                    <th>Schedule</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                {{--                            @inject('cases','App\Repository\CaseRepositoryInterface')--}}
                                {{--                            @foreach ($myUnScheduledCases as $case)--}}
                                {{--                                <tr>--}}
                                {{--                                    <td>{{ $case->number }}</td>--}}
                                {{--                                    <td>{{ $case->file->name }} {{ $case->file->surname }}</td>--}}
                                {{--                                    <td>--}}
                                {{--                                        @if ($case->schedule !== null)--}}
                                {{--                                            Start: {{ $case->schedule->start_time }}<br>--}}
                                {{--                                            End: {{ $case->schedule->end_time }}<br>--}}
                                {{--                                            Venue: {{ $case->schedule->venue }}--}}
                                {{--                                        @endif--}}
                                {{--                                    </td>--}}
                                {{--                                    <td>--}}
                                {{--                                        <span class="badge badge-info">{{ $case->status }}</span>--}}
                                {{--                                    </td>--}}
                                {{--                                    <td>--}}
                                {{--                                        <a class="btn btn-secondary btn-sm  text-center text-white" title="View Case"--}}
                                {{--                                           href="{{ route('cases.show', $case->id ) }}">--}}
                                {{--                                            <i class="fa fa-eye"></i>--}}
                                {{--                                        </a>--}}
                                {{--                                        <a class="btn btn-primary btn-sm  text-center text-white" title="Schedule case"--}}
                                {{--                                           href="{{ route('cases.show', $case->id ) }}">--}}
                                {{--                                            <i class="fa fa-calendar"></i>--}}
                                {{--                                        </a>--}}
                                {{--                                        <a class="btn btn-info btn-sm  text-center text-white" title="Open file"--}}
                                {{--                                           href="{{ route('files.show', $case->file->id) }}">--}}
                                {{--                                            <i class="fa fa-folder-open"></i>--}}
                                {{--                                        </a>--}}
                                {{--                                    </td>--}}
                                {{--                                </tr>--}}
                                {{--                            @endforeach--}}
                                </tbody>
                            </table>
                        </div>
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
            $('#example1').DataTable( {
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal( {
                            header: function ( row ) {
                                var data = row.data();
                                return 'Litigation Details for '+data[1];
                            }
                        } ),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                            tableClass: 'table'
                        } )
                    }
                },
            } );
            $('#example2').DataTable( {
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal( {
                            header: function ( row ) {
                                var data = row.data();
                                return 'Conveyancing Details for '+data[1];
                            }
                        } ),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                            tableClass: 'table'
                        } )
                    }
                },
            } );
        } );
    </script>
@endsection
