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
    <div class="container-fluid">
        <div class="row">
            <div class=" col-xl-3 col-md-6 mb-4 offset-md-1 offset-lg-1">
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
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 10%"
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

                                      </span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 10%"
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

                                      </span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 10%"
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
    </div>
    <div class="row">
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample1" class="d-block card-header py-3" data-toggle="collapse" role="button"
                   aria-expanded="true" aria-controls="collapseCardExample1">
                    <h5 class="m-0 font-weight-bold text-primary">  User Activities <span class="badge badge-primary">
                                       {{ $usersActivityLog->count() }}</span></h5>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse hide" id="collapseCardExample1">
                    <div class="card-body">
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
                                                {{ Str::ucfirst($activityLog->subject->name)
                                                 }}
                                                was {{ $activityLog->description === 'created'?
                                                       'added': $activityLog->description
                                                      }}
                                            </strong>
                                        </td>
                                        <td>
                                            <div class="alert {{ $activityLog->description === 'created'? 'alert-success':
                                        ($activityLog->description === 'updated'? 'alert-warning': 'alert-danger')}}"
                                                 role="alert">
                                                <div>
                                                    {{ $activityLog->causer === null ? 'System Developer':
                                                       $activityLog->causer->name }}
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
    </div>
    <div class="row">
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample2" class="d-block card-header py-3" data-toggle="collapse" role="button"
                   aria-expanded="true" aria-controls="collapseCardExample2">
                    <h5 class="m-0 font-weight-bold text-primary">File Activities <span class="badge badge-primary">
                                       {{ $filesActivityLog->count() }}</span></h5>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse hide" id="collapseCardExample2">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="fileActivities" cellspacing="0" width="100%" class="table display hover table-light table-bordered nowrap" >
                                <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($filesActivityLog->get() as $activityLog)
                                    @if($activityLog->subject !== null)
                                    <tr>
                                        <td class="d-xl-none">

                                            <strong class="alert-heading"> {{ $activityLog->subject->number }} was
                                                {{ $activityLog->description }}</strong>

                                        </td>
                                        <td>
                                            <div class="alert {{ $activityLog->description === 'created'? 'alert-success':
                                           ($activityLog->description === 'updated'? 'alert-warning': 'alert-danger')}}"
                                                 role="alert">
                                                <div class="searchable-title">
                                                    {{ $activityLog->causer === null ? 'System Developer':
                                                       $activityLog->causer->name }} {{ $activityLog->description }}
                                                    file
                                                    {{ $activityLog->subject->clientable != null ?$activityLog->subject->clientable->number : ''}} for
                                                    {{ $activityLog->subject->clientable != null? class_basename($activityLog->subject->clientable) :''}} client
                                                    {{  $activityLog->subject->clientable != null? $activityLog->subject->clientable->name : ''}}
                                                    @if(class_basename($activityLog->subject->clientable) == 'Individual')
                                                    {{ $activityLog->subject->clientable->surname }}
                                                    @endif
                                                    {{ \Carbon\CarbonImmutable::parse($activityLog->created_at)->calendar() }}

                                                </div>
                                                @if ($activityLog->description === 'updated')
                                                    <a class="alert alert-link" data-toggle="collapse" href="#content{{ $activityLog->id }}"
                                                       aria-expanded="false">
                                                        show change details of file
                                                    </a>
                                                    <div class="collapse" id="content{{ $activityLog->id }}">
                                                        <span class="badge badge-primary">New</span>
                                                        <ul>
                                                            @foreach($activityLog->getExtraProperty('attributes') as $key=> $attribute)
                                                                <li>  {{ $key . ': ' }}
                                                                    {{ $attribute ??  'None' }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                        <span class="badge badge-secondary">Old</span>
                                                        <ul>
                                                            @foreach($activityLog->getExtraProperty('old') as $key=> $attribute)
                                                                <li> {{ $key . ': ' }}
                                                                    {{ $attribute ??  'None' }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
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
    </div>
    <div class="row">
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample3" class="d-block card-header py-3" data-toggle="collapse" role="button"
                   aria-expanded="true" aria-controls="collapseCardExample3">
                    <h5 class="m-0 font-weight-bold text-primary">Litigation Activities
                        <span class="badge badge-primary">{{ $casesActivityLog->count() }}</span></h5>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse hide" id="collapseCardExample3">
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
                                                <strong class="alert-heading"> {{ $activityLog->subject->number }}
                                                    was {{ $activityLog->description }}</strong>
                                            </td>
                                            <td>
                                                <div class="alert {{ $activityLog->description === 'created'? 'alert-success':
                                        ($activityLog->description === 'updated'? 'alert-warning': 'alert-danger')}}"
                                                     role="alert">
                                                    <div>
                                                        {{ $activityLog->causer === null ? 'System Developer':
                                                      $activityLog->causer->name }} {{ $activityLog->description }}
                                                        case
                                                        {{ $activityLog->subject->number }}
                                                        for file
                                                        {{ $activityLog->subject->client->clientable->number }}
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
                                                                        <li>
                                                                            {{ $key === 'user.name'? 'Lawyer: ': $key.': ' }}
                                                                            {{ $attribute ??  'None' }}
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                                <span class="badge badge-secondary">Old</span>
                                                                <ul>
                                                                    @foreach($activityLog->getExtraProperty('old') as $key=> $attribute)
                                                                        <li> {{ $key === 'user.name'? 'Lawyer:': $key. ': ' }}
                                                                            {{ $attribute ??  'None' }}
                                                                        </li>
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
    </div>

    <div class="row">
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample5" class="d-block card-header py-3" data-toggle="collapse" role="button"
                   aria-expanded="true" aria-controls="collapseCardExample5">
                    <h5 class="m-0 font-weight-bold text-primary">Conveyancing Activities
                        <span class="badge badge-primary">{{ $conveyancingActivityLog->count() }}</span></h5>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse hide" id="collapseCardExample5">
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
                                    @foreach($conveyancingActivityLog->get() as $activityLog)
                                        @if($activityLog->subject != null)
                                        <tr>
                                            <td class="d-xl-none">
                                                <strong class="alert-heading"> {{ $activityLog->subject->number }}
                                                    was {{ $activityLog->description }}</strong>
                                            </td>
                                            <td>
                                                <div class="alert {{ $activityLog->description === 'created'? 'alert-success':
                                        ($activityLog->description === 'updated'? 'alert-warning': 'alert-danger')}}"
                                                     role="alert">
                                                    <div>
                                                        {{ $activityLog->causer === null ? 'System Developer':
                                                      $activityLog->causer->name }} {{ $activityLog->description }}
                                                        conveyancing
                                                        {{ $activityLog->subject->number }}
                                                        for file
                                                        {{ $activityLog->subject->client->clientable->number }}
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
                                                                        <li>
                                                                            {{ $key === 'user.name'? 'Lawyer: ': $key.': ' }}
                                                                            {{ $attribute ??  'None' }}
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                                <span class="badge badge-secondary">Old</span>
                                                                <ul>
                                                                    @foreach($activityLog->getExtraProperty('old') as $key=> $attribute)
                                                                        <li> {{ $key === 'user.name'? 'Lawyer:': $key. ': ' }}
                                                                            {{ $attribute ??  'None' }}
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endif
                                                    </div>

                                                </div>
                                            </td>
                                        </tr>
                                        @endif
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
    </div>

    <div class="row">
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample4" class="d-block card-header py-3" data-toggle="collapse" role="button"
                   aria-expanded="true" aria-controls="collapseCardExample4">
                    <h5 class="m-0 font-weight-bold text-primary">  Schedule Activities <span class="badge badge-primary">
                                       {{ $schedulesActivityLog->count() }}</span></h5>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse hide" id="collapseCardExample4">
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
                                                                        <li> {{ $key === 'case.user.name'? 'Lawyer:': $key. ': ' }}
                                                                            {{ $attribute ??  'None' }}
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                                <span class="badge badge-secondary">Old</span>
                                                                <ul>
                                                                    @foreach($activityLog->getExtraProperty('old') as $key=> $attribute)
                                                                        <li> {{ $key === 'case.user.name'? 'Lawyer:': $key. ': ' }}
                                                                            {{ $attribute ??  'None' }}
                                                                        </li>
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

                           "paging": true,
                           "scrollY": false,
                           "scrollX": false
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
