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
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pending Request</li>
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
                    <h6 class="m-0 font-weight-bold text-primary">Pending Litigation
                        {{--                        <span class="badge badge-primary"> {{ $litigation->getMyLitigation()->count() }}</span>--}}
                    </h6>
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
                                @foreach ($litigation->allLitigation() as $case)
                                    @if ($case->user === null)
                                        <tr>
                                            <td>{{ $case->number }}</td>
                                            <td>{{ $case->client->clientable->name }} {{$case->client->clientable->surname }}</td>
                                            <td>
                                                <span class="badge badge-info">{{ $case->status }}</span>
                                            </td>
                                            <td>
                                                <a class="btn btn-secondary btn-sm  text-center text-white" title="View Case"
                                                   href="{{ route('admin.litigation.show', $case->id ) }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a class="btn btn-primary btn-sm  text-center text-white" title="Schedule case"
                                                   href="{{ route('lawyer.schedule.create') }}">
                                                    <i class="fa fa-calendar"></i>
                                                </a>
                                                <a class="btn btn-info btn-sm  text-center text-white" title="Open file"
                                                   href="{{ route('client.show', $case->client->id) }}">
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
                                    <th>Conveyancing No</th>
                                    <th>Client</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                @inject('conveyancing','App\Repository\ConveyancingRepositoryInterface')
                                @foreach ($conveyancing->all() as $conveyance)
                                    @if($conveyance->user === null)
                                        <tr>
                                            <td>{{ $conveyance->number }}</td>
                                            <td>{{ $conveyance->client->clientable->name }} {{ $conveyance->client->clientable->surname }}</td>
                                            <td>
                                                <span class="badge badge-info">{{ $conveyance->status }}</span>
                                            </td>
                                            <td>
                                                <a class="btn btn-secondary btn-sm  text-center text-white" title="View Conveyancing"
                                                   href="{{ route('admin.conveyancing.show', $conveyance->id ) }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a class="btn btn-info btn-sm  text-center text-white" title="Open file"
                                                   href="{{ route('client.show', $conveyance->client->id) }}">
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
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
@section('custom-scripts')
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
