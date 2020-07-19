@extends('layouts.default')
@section('custom-links')
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a @php
                  $isLawyer =  auth()->user()->roles->first()->title === 'Lawyer'
            @endphp
                    href="{{  route($isLawyer? 'lawyer.dashboard': 'admin.dashboard') }}">Home
            </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Clients files</li>
        <li class="offset-11 d-sm-block" style="height: 10px;margin-top: -30px;">
            <a href="{{ url()->previous() }}" title="Back">
                <i class="fa fa-2x fa-chevron-circle-left"></i>
            </a>
        </li>
    </ol>
</nav>
@endsection

@section('content')
<!-- Content Row -->
<div class="row">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                @can('file_create')
                    <div class="dropdown open">
                        <button class="btn btn-info dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                            New Client File
                        </button>
                        <div class="dropdown-menu" aria-labelledby="triggerId">
                            <button class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#individualClientModal">Individual
                            </button>
                            <button class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#companyClientModal">Company
                            </button>
                            <button class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#retainerClientModal">Retainer
                            </button>
                        </div>
                    </div>
            @endcan
                <!-- Modal -->
                    <div class="modal fade" id="individualClientModal" tabindex="-1" role="dialog"
                     aria-labelledby="individualClientModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="clientModalLabel">
                                    <b>Client's Information - Individual</b>
                                </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.individual.store') }}"
                                  enctype="multipart/form-data" method="POST">
                                @csrf
                                @honeypot
                                 @include('partials.files.individual-form')
                                @include('partials.agreement-service')
                                @include('partials.modal-footer-submit-btn')
                            </form>
                        </div>
                    </div>
                </div>
                    <div class="modal fade" id="companyClientModal" tabindex="-1" role="dialog"
                         aria-labelledby="companyClientModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="clientModalLabel">
                                        <b>Client's Information - Company</b>
                                    </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('admin.company.store') }}"
                                      enctype="multipart/form-data" method="POST">
                                    @csrf
                                    @honeypot
                                    @include('partials.files.company-form')
                                    @include('partials.agreement-service')
                                    @include('partials.modal-footer-submit-btn')
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="retainerClientModal" tabindex="-1" role="dialog"
                         aria-labelledby="retainerClientModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                               @include('partials.files.retainer-form')
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
                            <h5 class="m-0 font-weight-bold text-primary"> Individual Clients <span class="badge badge-primary">
                                       {{ $individuals->count() }}</span></h5>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse hide" id="collapseCardExample1">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <input type="hidden" name="_token" value="{{ @csrf_token() }}">
                                    <div class="table-responsive">
                                        <table id="individual" class="table table-striped table-bordered nowrap" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>File No</th>
                                                <th>Client</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>

                                            <tbody>

                                            @foreach($individuals as $file)
                                                <tr>
                                                    <div class="modal fade" id="editClientFileModal{{ $file->id  }}" tabindex="-1"
                                                         role="dialog"
                                                         aria-labelledby="clientModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <form action="{{ route('admin.files.update',[$file->id]) }}"
                                                                      enctype="multipart/form-data" method="POST">
                                                                    @csrf
                                                                    @honeypot

                                                                    @method('PUT')
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="clientModalLabel">
                                                                            Edit Client File
                                                                            Information</h5>
                                                                        <button type="button" class="close" data-dismiss="modal"
                                                                                aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <x-individualForm
                                                                            :file="$file"
                                                                        />
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Save file</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <td>{{ $file->id }}</td>
                                                    <td>{{ $file->number }}</td>
                                                    <td>{{ $file->name }} {{ $file->surname }}</td>
                                                    <td>{{ $file->email }}</td>
                                                    <td>{{ $file->tel == 'N/A'? 'N/A': '+267 '.$file->tel }}</td>
                                                    <td>
                                                        @can('case_access')
                                                            <a class="btn btn-info btn-sm  text-center text-white"
                                                               href="{{ route('admin.files.show', $file->id) }}">
                                                                <i class="fa fa-file-contract"></i> Open</a>
                                                        @endcan
                                                        @can('file_edit')
                                                            <a class="btn btn-warning btn-sm  text-center text-white"
                                                               data-toggle="modal" data-target="#editClientFileModal{{ $file->id }}">
                                                                <i class="fa fa-pencil-alt"></i> Edit</a>
                                                        @endcan
                                                        @can('file_delete')
                                                            <button class="delete btn btn-danger btn-sm text-center text-white"
                                                                    id="{{ $file->id }}"
                                                                    data-id='{{ $file->id }}'>
                                                                <i class="fa fa-trash"></i>Delete</button>
                                                        @endcan
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
            </div>
            <div class="row">
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                        <a href="#collapseCardExample2" class="d-block card-header py-3" data-toggle="collapse" role="button"
                           aria-expanded="true" aria-controls="collapseCardExample2">
                            <h5 class="m-0 font-weight-bold text-primary"> Company Clients <span class="badge badge-primary">
                                       {{ $companies->count() }}</span></h5>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse hide" id="collapseCardExample2">
                            <div class="card-body">
                                <input type="hidden" name="_token" value="{{ @csrf_token() }}">
                                <div class="table-responsive">
                                    <table id="companies" class="table table-striped table-bordered nowrap" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>File No</th>
                                            <th>Client</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        @foreach($companies as $file)
                                            <tr>
                                                <div class="modal fade" id="editClientFileModal" tabindex="-1"
                                                     role="dialog"
                                                     aria-labelledby="clientModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <form action="{{ route('admin.files.update',[$file->id]) }}"
                                                                  enctype="multipart/form-data" method="POST">
                                                                @csrf
                                                                @honeypot

                                                                @method('PUT')
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="clientModalLabel">
                                                                        Edit Client File
                                                                        Information</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                            aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="inputName">Name</label>
                                                                            <input type="text" class="form-control"
                                                                                   id="name"
                                                                                   name="name" value="{{ $file->name }}">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="inputSurname">Surname</label>
                                                                            <input type="text" class="form-control"
                                                                                   id="surname"
                                                                                   name="surname" value="{{ $file->surname }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="inputEmail">Email</label>
                                                                            <input type="email" class="form-control"
                                                                                   id="email"
                                                                                   name="email" value="{{ $file->email }}">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="inputContact">Contact</label>
                                                                            <input type="tel" class="form-control"
                                                                                   name="contact" id="inputContact"
                                                                                   value="{{ $file->contact }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="dob">Date of Birth</label>
                                                                                <input type="date" class="form-control"
                                                                                       name="dob" id="dob"
                                                                                       value="{{ $file->dob }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="contact">Gender</label>
                                                                                <select class="form-control form-control-md"
                                                                                        name="gender" value="{{ $file->gender }}">
                                                                                    <option disabled>Select</option>
                                                                                    <option>Male</option>
                                                                                    <option>Female</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="inputAddress">Physical Address</label>
                                                                        <input type="text" class="form-control" id="inputAddress"
                                                                               name="physical_address"
                                                                               placeholder="1234 Main St"
                                                                               value="{{ $file->physical_address }}"
                                                                        >
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="inputAddress2">Postal Address</label>
                                                                        <input type="text" class="form-control"
                                                                               name="postal_address" id="inputAddress2"
                                                                               value="{{ $file->postal_address }}"
                                                                        >
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save file</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <td>{{ $file->id }}</td>
                                                <td>{{ $file->number }}</td>
                                                <td>{{ $file->name }} {{ $file->surname }}</td>
                                                <td>{{ $file->email }}</td>
                                                <td>{{ $file->tel == 'N/A'? 'N/A': '+267 '.$file->tel }}</td>
                                                <td>
                                                    @can('case_access')
                                                        <a class="btn btn-info btn-sm  text-center text-white"
                                                           href="{{ route('admin.files.show', $file->id) }}">
                                                            <i class="fa fa-file-contract"></i> Open</a>
                                                    @endcan
                                                    @can('file_edit')
                                                        <a class="btn btn-warning btn-sm  text-center text-white"
                                                           data-toggle="modal" data-target="#editClientFileModal"><i class="fa
                                fa-pencil-alt"></i> Edit</a>
                                                    @endcan
                                                    @can('file_delete')
                                                        <button class="delete btn btn-danger btn-sm text-center text-white"
                                                                id="{{ $file->id }}"
                                                                data-id='{{ $file->id }}'>
                                                            <i class="fa fa-trash"></i>Delete</button>
                                                    @endcan
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
                        <a href="#collapseCardExample3" class="d-block card-header py-3" data-toggle="collapse" role="button"
                           aria-expanded="true" aria-controls="collapseCardExample3">
                            <h5 class="m-0 font-weight-bold text-primary">  Retainers Clients
                                <span class="badge badge-primary">{{ $retainers->count() }}</span></h5>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse hide" id="collapseCardExample3">
                            <div class="card-body">
                                <div class="row">
                                    <!-- Begin Page Content -->
                                    <input type="hidden" name="_token" value="{{ @csrf_token() }}">
                                    <div class="table-responsive">
                                        <table id="retainers" class="table table-striped table-bordered nowrap" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>File No</th>
                                                <th>Client</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>

                                            <tbody>

                                            @foreach($retainers as $file)
                                                <tr>
                                                    <div class="modal fade" id="editClientFileModal" tabindex="-1"
                                                         role="dialog"
                                                         aria-labelledby="clientModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <form action="{{ route('admin.files.update',[$file->id]) }}"
                                                                      enctype="multipart/form-data" method="POST">
                                                                    @csrf
                                                                    @honeypot

                                                                    @method('PUT')
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="clientModalLabel">
                                                                            Edit Client File
                                                                            Information</h5>
                                                                        <button type="button" class="close" data-dismiss="modal"
                                                                                aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-row">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="inputName">Name</label>
                                                                                <input type="text" class="form-control"
                                                                                       id="name"
                                                                                       name="name" value="{{ $file->name }}">
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="inputSurname">Surname</label>
                                                                                <input type="text" class="form-control"
                                                                                       id="surname"
                                                                                       name="surname" value="{{ $file->surname }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-row">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="inputEmail">Email</label>
                                                                                <input type="email" class="form-control"
                                                                                       id="email"
                                                                                       name="email" value="{{ $file->email }}">
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="inputContact">Contact</label>
                                                                                <input type="tel" class="form-control"
                                                                                       name="contact" id="inputContact"
                                                                                       value="{{ $file->contact }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-row">
                                                                            <div class="form-group col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="dob">Date of Birth</label>
                                                                                    <input type="date" class="form-control"
                                                                                           name="dob" id="dob"
                                                                                           value="{{ $file->dob }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="contact">Gender</label>
                                                                                    <select class="form-control form-control-md"
                                                                                            name="gender" value="{{ $file->gender }}">
                                                                                        <option disabled>Select</option>
                                                                                        <option>Male</option>
                                                                                        <option>Female</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="inputAddress">Physical Address</label>
                                                                            <input type="text" class="form-control" id="inputAddress"
                                                                                   name="physical_address"
                                                                                   placeholder="1234 Main St"
                                                                                   value="{{ $file->physical_address }}"
                                                                            >
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="inputAddress2">Postal Address</label>
                                                                            <input type="text" class="form-control"
                                                                                   name="postal_address" id="inputAddress2"
                                                                                   value="{{ $file->postal_address }}"
                                                                            >
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Save file</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <td>{{ $file->id }}</td>
                                                    <td>{{ $file->number }}</td>
                                                    <td>{{ $file->name }} {{ $file->surname }}</td>
                                                    <td>{{ $file->email }}</td>
                                                    <td>{{ $file->tel == 'N/A'? 'N/A': '+267 '.$file->tel }}</td>
                                                    <td>
                                                        @can('case_access')
                                                            <a class="btn btn-info btn-sm  text-center text-white"
                                                               href="{{ route('admin.files.show', $file->id) }}">
                                                                <i class="fa fa-file-contract"></i> Open</a>
                                                        @endcan
                                                        @can('file_edit')
                                                            <a class="btn btn-warning btn-sm  text-center text-white"
                                                               data-toggle="modal" data-target="#editClientFileModal"><i class="fa
                                fa-pencil-alt"></i> Edit</a>
                                                        @endcan
                                                        @can('file_delete')
                                                            <button class="delete btn btn-danger btn-sm text-center text-white"
                                                                    id="{{ $file->id }}"
                                                                    data-id='{{ $file->id }}'>
                                                                <i class="fa fa-trash"></i>Delete</button>
                                                        @endcan
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

        </div>

    </div>
    <!-- /.container-fluid -->
</div>
@endsection

@section('custom-scripts')
<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/responsive.bootstrap4.min.js') }}"></script>
<!-- jQuery library -->

<!-- Latest compiled JavaScript --><!-- Page level plugins -->
<script src="{{ asset('js/bootbox.min.js') }}"></script>
<script type="application/javascript">
    $(document).ready(function() {
        $('.delete').click(function(){
            var el = this;

            // Delete id
            let file = $(this).data('id');
            console.log('id = '+file);
            // Confirm box
            bootbox.confirm("Do you really want to delete record?", function(result) {
                let url = '{{ route("admin.files.destroy",["file"=> ":id"]) }}';
                url = url.replace(':id', file);
                console.log('url = '+url);
                if(result){
                    // AJAX Request
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            '_token' : $('input[name="_token"]').val(),
                            'honeypot': 'update',
                            _method: 'delete'
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response){

                            // Removing row from HTML Table
                            console.log(response);
                            if(response == 1){
                                $(el).closest('tr').css('background','tomato');
                                $(el).closest('tr').fadeOut(800,function(){
                                    $(this).remove();
                                });
                                window.location.reload();
                            }else{
                                bootbox.alert('Record not deleted.');
                            }

                        }
                    });
                }

            });

        });
        $('#retainerCompanyForm').hide();
        $('#retainerIndividualForm').hide();
        $('#submit_div').hide();
        $("#retainerType").change(function () {
           let retainerType = $("#retainerType :selected").text();
           $('#submit_div').show();
           switch (retainerType) {
               case 'Individual':
                   $('#retainerIndividualForm').show();
                   $('#retainerCompanyForm').hide();
                   break;
               case 'Company':
                   $('#retainerCompanyForm').show();
                   $('#retainerIndividualForm').hide();
                   break;
               case 'Both':
                   $('#retainerCompanyForm').show();
                   $('#retainerIndividualForm').show();
                   break;
               default:
                   $('#retainerCompanyForm').hide();
                   $('#retainerIndividualForm').hide();
                   $('#submit_div').hide();
                   break;
           }
        });
        $('#individual').DataTable( {
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal( {
                        header: function ( row ) {
                            var data = row.data();
                            return 'File Details for '+data[1];
                        }
                    } ),
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                        tableClass: 'table'
                    } )
                }
            }
        } );
        $('#companies').DataTable( {
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
        $('#retainers').DataTable( {
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
