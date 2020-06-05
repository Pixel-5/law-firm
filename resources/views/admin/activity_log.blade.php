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
                <li class="breadcrumb-item active" aria-current="page">Activity Logs</li>
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
    <div class="row ">
        <div class="offset-1 col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a
                                        href="{{ route('admin.files.index') }}">Users Logged In Today</a></div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    <span class="badge badge-primary">
                                        0
                                      </span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: {{ $files->count() }}%"
                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Users Logged In Last 7 Days
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    <span class="badge badge-primary">
                                         {{ $files->count() }}
                                      </span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: {{ $files->count() }}%"
                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Users Logged In Last 30 days
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    <span class="badge badge-primary">
                                         {{ $files->count() }}
                                      </span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: {{ $files->count() }}%"
                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-times fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="accordianId" role="tablist" aria-multiselectable="true" class="offset-1">
        <div class="card">
            <div class="card-header" role="tab" id="section1HeaderId">
                <h5 class="mb-0">
                    <a data-toggle="collapse" data-parent="#accordianId" href="#section1ContentId"
                       aria-expanded="true" aria-controls="section1ContentId">
                        User Activities <span class="badge badge-primary">
                                       {{ $usersActivityLog->count() }}</span>
                    </a>
                </h5>
            </div>
            <div id="section1ContentId" class="collapse in" role="tabpanel" aria-labelledby="section1HeaderId">
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table id="userActivities" cellspacing="0" width="100%"
                                   class="table display hover table-light table-bordered nowrap" >
                                <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($usersActivityLog->get() as $activityLog)
                                    <tr>
                                        <td class="d-xl-none">
                                            <strong class="alert-heading">
                                                {{ Str::ucfirst($activityLog->subject->roles()->first()->title) }}
                                                {{ $activityLog->subject->name }}
                                                has been {{ $activityLog->description }}</strong>
                                        </td>
                                        <td>
                                            <div class="alert {{ $activityLog->description === 'created'? 'alert-success':
                                        ($activityLog->description === 'updated'? 'alert-warning': 'alert-danger')}}"
                                                 role="alert">
                                                <div>
                                                    {{ $activityLog->causer->name }}
                                                    {{ $activityLog->description === 'created'?
                                                         'added': $activityLog->description }}
                                                    {{ $activityLog->subject->name }} as
                                                    {{ Str::ucfirst($activityLog->subject->roles()->first()->title) }}
                                                    {{ \Carbon\CarbonImmutable::parse($activityLog->created_at)->calendar() }}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-header" role="tab" id="section2HeaderId">
                <h5 class="mb-0">
                    <a data-toggle="collapse" data-parent="#accordianId" href="#section2ContentId"
                       aria-expanded="true" aria-controls="section2ContentId">
                        File Activities <span class="badge badge-primary">
                                       {{ $filesActivityLog->count() }}</span>
                    </a>
                </h5>
            </div>
            <div id="section2ContentId" class="collapse in" role="tabpanel" aria-labelledby="section2HeaderId">
                <div class="card-body">
                    <div class="row">
                        <!-- Begin Page Content -->
                        <div class="table-responsive">
                            <table id="userActivities" cellspacing="0" width="100%" class="table display hover table-light table-bordered nowrap" >
                                <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($filesActivityLog->get() as $activityLog)
                                    <tr>
                                        <td class="d-xl-none">
                                            <strong class="alert-heading">  Client File has been
                                                {{ $activityLog->description }}</strong>
                                        </td>
                                        <td>
                                            <div class="alert {{ $activityLog->description === 'created'? 'alert-success':
                                           ($activityLog->description === 'updated'? 'alert-warning': 'alert-danger')}}"
                                                 role="alert">
                                                <div class="searchable-title">
                                                    {{ $activityLog->causer->name }} {{ $activityLog->description }}
                                                    file
                                                    {{ $activityLog->subject->number }} for client
                                                    {{ $activityLog->getExtraProperty('attributes')['name'] }}
                                                    {{ $activityLog->getExtraProperty('attributes')['surname'] }}
                                                    {{ \Carbon\CarbonImmutable::parse($activityLog->created_at)->calendar() }}
                                                    @if ($activityLog->description === 'updated')
                                                        <a class="alert alert-link" data-toggle="collapse" href="#content{{ $activityLog->id }}"
                                                           aria-expanded="false">
                                                            show change details of file
                                                        </a>
                                                        <div class="collapse" id="content{{ $activityLog->id }}">
                                                            <span class="badge badge-primary">New</span>
                                                            <ul>
                                                                @foreach($activityLog->getExtraProperty('attributes') as $key=> $attribute)
                                                                    <li> {{ $key }} {{ $attribute }}</li>
                                                                @endforeach
                                                            </ul>
                                                            <span class="badge badge-secondary">Old</span>
                                                            <ul>
                                                                @foreach($activityLog->getExtraProperty('old') as $key=> $attribute)
                                                                    <li> {{ $key }} {{ $attribute }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.container-fluid -->
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-header" role="tab" id="section3HeaderId">
                <h5 class="mb-0">
                    <a data-toggle="collapse" data-parent="#accordianId" href="#section3ContentId"
                       aria-expanded="true" aria-controls="section2ContentId">
                        Case Activities <span class="badge badge-primary">{{ $casesActivityLog->count() }}</span>
                    </a>
                </h5>
            </div>
            <div id="section3ContentId" class="collapse in" role="tabpanel" aria-labelledby="section3HeaderId">
                <div class="card-body">
                    <div class="row">
                        <!-- Begin Page Content -->
                        <div class="table-responsive">
                            <table id="caseActivities" cellspacing="0" width="100%"
                                   class="table display hover table-light table-bordered nowrap" >
                                <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($casesActivityLog->get() as $activityLog)
                                    <tr>
                                        <td class="d-xl-none">
                                            <strong class="alert-heading">  Case {{ $activityLog->subject->number }}
                                                has been {{ $activityLog->description }}</strong>
                                        </td>
                                        <td>
                                            <div class="alert {{ $activityLog->description === 'created'? 'alert-success':
                                        ($activityLog->description === 'updated'? 'alert-warning': 'alert-danger')}}"
                                                 role="alert">
                                                <div>
                                                    {{ $activityLog->causer->name }} {{ $activityLog->description }}
                                                    case
                                                    {{ $activityLog->subject->number }}
                                                    for file
                                                    {{ $activityLog->subject->file->number }}
                                                    {{ \Carbon\CarbonImmutable::parse($activityLog->created_at)->calendar() }}
                                                    <br>
                                                    @if ($activityLog->description === 'updated')
                                                        <a class="alert alert-link" data-toggle="collapse" href="#content{{ $activityLog->id }}"
                                                           aria-expanded="false">
                                                            show change details of case
                                                        </a>
                                                        <div class="collapse" id="content{{ $activityLog->id }}">
                                                            <span class="badge badge-primary">New</span>
                                                            <ul>
                                                                @foreach($activityLog->getExtraProperty('attributes') as $key=> $attribute)
                                                                    <li> {{ $key === 'user.name'? 'Lawyer': $key }} {{ $attribute }}</li>
                                                                @endforeach
                                                            </ul>
                                                            <span class="badge badge-secondary">Old</span>
                                                            <ul>
                                                                @foreach($activityLog->getExtraProperty('old') as $key=> $attribute)
                                                                    <li> {{ $key === 'user.name'? 'Lawyer': $key }} {{ $attribute }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.container-fluid -->
                    </div>
                </div>
            </div>
        </div>

        <br>
        <div class="card">
            <div class="card-header" role="tab" id="section3HeaderId">
                <h5 class="mb-0">
                    <a data-toggle="collapse" data-parent="#accordianId" href="#section4ContentId"
                       aria-expanded="true" aria-controls="section2ContentId">
                        Case Schedule Activities <span class="badge badge-primary">
                                       {{ $schedulesActivityLog->count() }}</span>
                    </a>
                </h5>
            </div>
            <div id="section4ContentId" class="collapse in" role="tabpanel" aria-labelledby="section4HeaderId">
                <div class="card-body">
                    <div class="row">
                        <!-- Begin Page Content -->
                        <div class="table-responsive">
                            <table id="scheduleActivities" cellspacing="0" width="100%"
                                   class="table display hover table-light table-bordered nowrap" >
                                <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($schedulesActivityLog->get() as $activityLog)
                                    <tr>
                                        <td class="d-xl-none">
                                            <strong class="alert-heading">  {{ $activityLog->subject->case->number  }}
                                                has been {{ $activityLog->description }}</strong>
                                        </td>
                                        <td>
                                            <div class="alert {{ $activityLog->description === 'created'? 'alert-success':
                                        ($activityLog->description === 'updated'? 'alert-warning': 'alert-danger')}}"
                                                 role="alert">
                                                <div>
                                                    {{ $activityLog->causer->name }} {{ $activityLog->description }}
                                                    schedule
                                                    {{ $activityLog->subject->case->number }}
                                                    {{ \Carbon\CarbonImmutable::parse($activityLog->created_at)->calendar() }}
                                                    <br>
                                                    @if ($activityLog->description === 'updated')
                                                        <a class="alert alert-link" data-toggle="collapse" href="#content{{ $activityLog->id }}"
                                                           aria-expanded="false">
                                                            show change details of a schedule
                                                        </a>
                                                        <div class="collapse" id="content{{ $activityLog->id }}">
                                                            <span class="badge badge-primary">New</span>
                                                            <ul>
                                                                @foreach($activityLog->getExtraProperty('attributes') as $key=> $attribute)
                                                                    <li> {{ $key === 'case.user.name'? 'Lawyer': $key }} {{ $attribute }}</li>
                                                                @endforeach
                                                            </ul>
                                                            <span class="badge badge-secondary">Old</span>
                                                            <ul>
                                                                @foreach($activityLog->getExtraProperty('old') as $key=> $attribute)
                                                                    <li> {{ $key === 'case.user.name'? 'Lawyer': $key }} {{ $attribute }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.container-fluid -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
   @section('custom-scripts')
       <!-- Custom scripts for all pages-->

       <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
       <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
       <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
       <script src="{{ asset('js/responsive.bootstrap4.min.js') }}"></script>
           <script type="application/javascript">
               $(document).ready(function() {
                   $('#fileActivities').DataTable( {
                       responsive: {
                           details: {
                               display: $.fn.dataTable.Responsive.display.modal( {
                                   header: function ( row ) {
                                       let data = row.data();
                                       return data[0];
                                   },
                               } ),
                               renderer: function ( api, rowIdx, columns ) {
                                   var data = $.map( columns, function ( col, i ) {
                                       return col.columnIndex === 1?
                                           '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                                           '<td>'+col.title+':'+'</td> '+
                                           '<td>'+col.data+'</td>'+
                                           '</tr>' :
                                           '';
                                   } ).join('');

                                   return data;
                               }
                           },

                           "paging": true
                       },
                   } );
                   $('#caseActivities').DataTable( {
                       responsive: {
                           details: {
                               display: $.fn.dataTable.Responsive.display.modal( {
                                   header: function ( row ) {
                                       let data = row.data();
                                       return data[0];
                                   },
                               } ),
                               renderer: function ( api, rowIdx, columns ) {
                                   var data = $.map( columns, function ( col, i ) {
                                       return col.columnIndex === 1?
                                           '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                                           '<td>'+col.title+':'+'</td> '+
                                           '<td>'+col.data+'</td>'+
                                           '</tr>' :
                                           '';
                                   } ).join('');

                                   return data;
                               }
                           },

                           "paging": true
                       },
                   } );
                   $('#scheduleActivities').DataTable( {
                       responsive: {
                           details: {
                               display: $.fn.dataTable.Responsive.display.modal( {
                                   header: function ( row ) {
                                       let data = row.data();
                                       return data[0];
                                   },
                               } ),
                               renderer: function ( api, rowIdx, columns ) {
                                   var data = $.map( columns, function ( col, i ) {
                                       return col.columnIndex === 1?
                                           '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                                           '<td>'+col.title+':'+'</td> '+
                                           '<td>'+col.data+'</td>'+
                                           '</tr>' :
                                           '';
                                   } ).join('');

                                   return data;
                               }
                           },

                           "paging": true
                       },
                   } );
                   $('#userActivities').DataTable( {
                       responsive: {
                           details: {
                               display: $.fn.dataTable.Responsive.display.modal( {
                                   header: function ( row ) {
                                       let data = row.data();
                                       return data[0];
                                   },
                               } ),
                               renderer: function ( api, rowIdx, columns ) {
                                   var data = $.map( columns, function ( col, i ) {
                                       return col.columnIndex === 1?
                                           '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                                           '<td>'+col.title+':'+'</td> '+
                                           '<td>'+col.data+'</td>'+
                                           '</tr>' :
                                           '';
                                   } ).join('');

                                   return data;
                               }
                           },

                           "paging": true
                       },
                   } );
               } );
           </script>
@endsection