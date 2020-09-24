@extends('layouts.default')
<!--  Content -->
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
                </a></li>
            <li class="breadcrumb-item"><a href="{{ route('files.index') }}">Files</a></li>
            <li class="breadcrumb-item"><a>{{ $file->clientable->number }}</a></li>
            <li class="offset-11 d-sm-block" style="height: 10px;margin-top: -30px;">
                <a href="{{ url()->previous() }}" title="Back">
                    <i class="fa fa-2x fa-chevron-circle-left"></i>
                </a>
            </li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="row">
        <div class="container-fluid">
            <div class="alert alert-primary fade show" role="alert">
                {{--        --}}
                @can('case_create')
                    <div class="row-cols-3">
                        <a href="#" class="btn btn-md btn-outline-primary shadow-sm" data-toggle="modal" data-target="#openClientCaseModal">
                            <i class="fa fa-balance-scale fa-sm text-dark-100"></i> Litigation
                        </a>
                        <a href="#" class="btn btn-md btn-outline-primary shadow-sm" style="font-size: 14px;"
                           data-toggle="modal" data-target="#openClientConveyanceModal">
                            <i class="fa fa-file-pdf fa-sm text-dark-100"></i> Conveyance
                        </a>
{{--                        @can('file_edit')--}}
{{--                            <a href="#" class="btn d-sm-block btn-outline-secondary shadow-sm float-right" data-toggle="modal" data-target="#openClientCaseModal">--}}
{{--                                <i class="fa fa-pencil-alt fa-sm text-dark-100"></i> Edit</a>--}}
{{--                        @endcan--}}
                    </div>
                    <!-- Modal -->
{{--                    <div class="modal fade" id="openClientCaseModal" tabindex="-1" role="dialog"--}}
{{--                         aria-labelledby="openClientCaseModalLabel" aria-hidden="true">--}}
{{--                        <div class="modal-dialog modal-lg" role="document">--}}
{{--                            <div class="modal-content">--}}
{{--                                <div class="modal-header">--}}
{{--                                    <h5 class="modal-title" id="openClientCaseModalLabel">Litigation Information Form</h5>--}}
{{--                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                        <span aria-hidden="true">&times;</span>--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                                <div class="modal-body">--}}
{{--                                   @if(class_basename($file->clientable) =='Individual')--}}
{{--                                        <form id="individualLitigation_data" method="POST"--}}
{{--                                              action="{{ route('admin.litigation.store') }}"--}}
{{--                                              enctype="multipart/form-data">--}}
{{--                                            @honeypot--}}
{{--                                            @csrf--}}
{{--                                            <div class="container-fluid">--}}
{{--                                                <div class="container-fluid">--}}
{{--                                                    <div class="alert alert-secondary" role="alert">--}}
{{--                                                        CLIENT'S INFORMATION - INDIVIDUAL--}}
{{--                                                    </div>--}}
{{--                                                    <div class="form-row">--}}
{{--                                                        <div class="form-group col-10">--}}
{{--                                                            <select class="form-control form-control-md"  name="category" required>--}}
{{--                                                                <option disabled selected value="">Select Litigation Category</option>--}}
{{--                                                                <option value="matrimonial">A (Matrimonial)</option>--}}
{{--                                                                <option>B</option>--}}
{{--                                                                <option>C</option>--}}
{{--                                                                <option>D</option>--}}
{{--                                                                <option>E</option>--}}
{{--                                                            </select>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <input type="hidden" name="client_id" value="{{ $file->id }}">--}}
{{--                                                <x-individualForm :file="$file->clientable"/>--}}
{{--                                            </div>--}}
{{--                                            <div class="modal-footer">--}}
{{--                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                                                <button type="submit" class="btn btn-primary">Save</button>--}}
{{--                                            </div>--}}
{{--                                        </form>--}}
{{--                                    @else--}}
{{--                                        <form id="companyLitigation_data" method="POST" action="{{ route('admin.litigation.store') }}"--}}
{{--                                              enctype="multipart/form-data">--}}
{{--                                            @honeypot--}}
{{--                                            @csrf--}}
{{--                                            <div class="container-fluid">--}}
{{--                                                <div class="alert alert-secondary" role="alert">--}}
{{--                                                    CLIENT'S INFORMATION - COMPANY--}}
{{--                                                </div>--}}
{{--                                                <div class="form-row">--}}
{{--                                                    <div class="form-group col-10">--}}
{{--                                                        <select class="form-control form-control-md"  name="category" required>--}}
{{--                                                            <option disabled selected value="">Select Litigation Category</option>--}}
{{--                                                            <option>B</option>--}}
{{--                                                            <option>C</option>--}}
{{--                                                            <option>D</option>--}}
{{--                                                            <option>E</option>--}}
{{--                                                        </select>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <input type="hidden" name="client_id" value="{{ $file->id }}">--}}
{{--                                            </div>--}}
{{--                                            <div class="modal-footer">--}}
{{--                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                                                <button type="submit" class="btn btn-primary">Save</button>--}}
{{--                                            </div>--}}
{{--                                        </form>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="modal fade" id="openClientConveyanceModal" tabindex="-1" role="dialog"
                         aria-labelledby="openClientConveyanceModal" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header  alert alert-primary" role="alert">
                                    <h4 class="modal-title">
                                        Conveyancing Information Form
                                    </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @include('client.file.individual.conveyance_form',['file'=>$file])
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
    </div>
    <div class="row">
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample1" class="d-block card-header py-3" data-toggle="collapse" role="button"
                   aria-expanded="true" aria-controls="collapseCardExample1">
                    <h5 class="m-0 font-weight-bold text-primary"> Litigation
                        <span class="badge badge-primary">{{ $file->litigation->count() }}</span></h5>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse hide" id="collapseCardExample1">
                    <div class="card-body">
                        <input type="hidden" name="_token" value="{{ @csrf_token() }}">
                        <div class="table-responsive">
                            <table id="litigationTable" class="table table-striped table-bordered nowrap" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Form No</th>
                                    <th>Category</th>
                                    <th>Lawyer</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($file->litigation as $litigation)
                                    <tr>
                                        <div class="modal fade" id="editClientFileModal{{ $litigation->id  }}" tabindex="-1"
                                             role="dialog"
                                             aria-labelledby="clientModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('admin.litigation.update',[$litigation->id]) }}"
                                                          enctype="multipart/form-data" method="POST">
                                                        @csrf
                                                        @honeypot
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="clientModalLabel">
                                                                Edit Client Litigation Form</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @if(class_basename($file->clientable) == 'Individual')
                                                                <div class="form-row">
                                                                    <div class="form-group col-10">
                                                                        <select class="form-control form-control-md"  name="category" required>
                                                                            <option disabled selected value="">Select Litigation Category</option>
                                                                            <option value="matrimonial">A (Matrimonial)</option>
                                                                            <option>B</option>
                                                                            <option>C</option>
                                                                            <option>D</option>
                                                                            <option>E</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                            @else
                                                                <div class="form-row">
                                                                    <div class="form-group col-10">
                                                                        <select class="form-control form-control-md"
                                                                                name="category" required>
                                                                            <option disabled selected value="">
                                                                                Select Litigation Category
                                                                            </option>
                                                                            <option>B</option>
                                                                            <option>C</option>
                                                                            <option>D</option>
                                                                            <option>E</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save file</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <td>{{ $litigation->id }}</td>
                                        <td>{{ $litigation->number }}</td>
                                        <th>{{ $litigation->category }}</th>
                                        <td>{{ $litigation->user != null ? $litigation->user->name: "" }}</td>
                                        <td>
{{--                                            @can('case_access')--}}
{{--                                                <a class="btn btn-info btn-sm  text-center text-white"--}}
{{--                                                   href="{{ route('admin.client.show', $litigation->id) }}">--}}
{{--                                                    <i class="fa fa-eye"></i> view</a>--}}
{{--                                            @endcan--}}
                                            @can('case_access')
                                                @include('partials.dropdown-lawyers',[ 'user' => $litigation->user])
                                            @endcan
                                            @can('file_edit')
                                                <a class="btn btn-warning btn-sm  text-center text-white"
                                                   data-toggle="modal" data-target="#editClientFileModal{{ $litigation->id }}">
                                                    <i class="fa fa-pencil-alt"></i> Edit</a>
                                            @endcan
                                            @can('file_delete')
                                                <button class="delete btn btn-danger btn-sm text-center text-white"
                                                        id="{{ $litigation->id }}"
                                                        data-id='{{ $litigation->id }}'>
                                                    <i class="fa fa-trash"></i>Delete
                                                </button>
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
                <a href="#collapseCardExample2" class="d-block card-header py-3" data-toggle="collapse" role="button"
                   aria-expanded="true" aria-controls="collapseCardExample2">
                    <h5 class="m-0 font-weight-bold text-primary"> Conveyancing
                        <span class="badge badge-primary">{{ $file->conveyancing->count() }}</span></h5>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse hide" id="collapseCardExample2">
                    <div class="card-body">
                        <input type="hidden" name="_token" value="{{ @csrf_token() }}">
                        <div class="table-responsive">
                           <table id="conveyanceTable" class="table table-striped table-bordered nowrap" style="width:100%">
                               <thead>
                                   <tr>
                                       <th>#</th>
                                       <th>Plot No</th>
                                       <th>Transaction Type</th>
                                       <th>Other Type</th>
                                       <th>Lawyer</th>
                                       <th>Action</th>
                                   </tr>
                               </thead>
                               <tbody>
                                   @foreach($file->conveyancing as $conveyance)
                                       <tr id="{{ $conveyance->id }}">
                                           <div class="modal fade" id="editClientFileModal{{ $conveyance->id  }}" tabindex="-1"
                                                role="dialog"
                                                aria-labelledby="clientModalLabel" aria-hidden="true">
                                               <div class="modal-dialog modal-lg" role="document">
                                                   <div class="modal-content">
                                                       <form action="{{ route('admin.individual.update',[$conveyance->id]) }}"
                                                             enctype="multipart/form-data" method="POST">
                                                           @csrf
                                                           @honeypot
                                                           @method('PUT')
                                                           <div class="modal-header">
                                                               <h5 class="modal-title" id="clientModalLabel">
                                                                   Edit Client File Information</h5>
                                                               <button type="button" class="close" data-dismiss="modal"
                                                                       aria-label="Close">
                                                                   <span aria-hidden="true">&times;</span>
                                                               </button>
                                                           </div>
                                                           <div class="modal-body">
                                                               <x-individualForm :file="$conveyance"/>
                                                           </div>
                                                           <div class="modal-footer">
                                                               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                               <button type="submit" class="btn btn-primary">Save file</button>
                                                           </div>
                                                       </form>
                                                   </div>
                                               </div>
                                           </div>
                                           <td>{{ $conveyance->id }}</td>
                                           <td>{{ $conveyance->transaction->plot->plot_no }}</td>
                                           <td>{{ $conveyance->transaction->transaction_type }}</td>
                                           <td>{{ $conveyance->other_type }}</td>
                                           <td>{{ $conveyance->user == null ? "" : $conveyance->user->name }}</td>
                                           <td>
{{--                                               @can('case_access')--}}
{{--                                                   <a class="btn btn-info btn-sm  text-center text-white"--}}
{{--                                                      href="{{ route('client.show', $conveyance->id) }}">--}}
{{--                                                       <i class="fa fa-eye"></i> view</a>--}}
{{--                                               @endcan--}}
                                               @can('case_access')
                                                       @include('partials.dropdown-lawyers',[ 'user' => $conveyance->user])
                                               @endcan
{{--                                               @can('file_edit')--}}
{{--                                                   <a class="btn btn-warning btn-sm  text-center text-white"--}}
{{--                                                      data-toggle="modal" data-target="#editClientFileModal{{ $conveyance->id }}">--}}
{{--                                                       <i class="fa fa-pencil-alt"></i> Edit</a>--}}
{{--                                               @endcan--}}
                                               @can('file_delete')
                                                   <button class="delete btn btn-danger btn-sm text-center text-white"
                                                           id="{{ $conveyance->id }}"
                                                           data-id='{{ $conveyance->id }}'>
                                                       <i class="fa fa-trash"></i>Delete
                                                   </button>
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
@endsection
<!-- /.container-fluid -->
@section('custom-scripts')
    @include('partials.case-delete-btn')

    <script src="{{ asset('js/bootbox.min.js') }}"></script>
    <!-- Page level plugins -->
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/responsive.bootstrap4.min.js') }}"></script>
    <script type="application/javascript">
        $(document).ready(function() {

            $('#individualsTransferorConveyancing_data').addClass('hidden');
            $('#individualsTransfereeConveyancing_data').addClass('hidden');

            $('#companiesTransferorConveyancing_data').addClass('hidden');
            $('#companiesTransfereeConveyancing_data').addClass('hidden');

            $('#individualTransferorCompanyconveyancing_data').addClass('hidden');
            $('#individualTransfereeCompanyconveyancing_data').addClass('hidden');

            $('#companyTransferorIndividualconveyancing_data').addClass('hidden');
            $('#companyTransfereeIndividualconveyancing_data').addClass('hidden');

            $("#client_info_transferor").on('click',function (){

                $('#client_info_transferee').hide();
                $('#transferee_client_info_clear').hide();

                let transferorType = $("#transferor_type :selected").text();
                let transfereeType = $("#transferee_type :selected").text();

                $('#individualsConveyancing').addClass('hidden');
                $('#companiesConveyancing').addClass('hidden');

                $('#individualCompanyconveyancing').addClass('hidden');
                $('#companyIndividualconveyancing').addClass('hidden');

                $('#individualsTransferorConveyancing_data').addClass('hidden');
                $('#individualsTransfereeConveyancing_data').addClass('hidden');

                $('#companiesTransferorConveyancing_data').addClass('hidden');
                $('#companiesTransfereeConveyancing_data').addClass('hidden');

                $('#individualTransferorCompanyconveyancing_data').addClass('hidden');
                $('#individualTransfereeCompanyconveyancing_data').addClass('hidden');

                $('#companyTransferorIndividualconveyancing_data').addClass('hidden');
                $('#companyTransfereeIndividualconveyancing_data').addClass('hidden');

                switch (transferorType) {
                    case 'Individual':
                        if (transfereeType== 'Individual'){
                            $('#individualsConveyancing').addClass('hidden');
                            $("#individualsTransferorConveyancing_data").removeClass('hidden');
                        }else if (transfereeType== 'Company'){
                            $('#individualCompanyconveyancing').addClass('hidden');
                            $("#individualTransferorCompanyconveyancing_data").removeClass('hidden');
                        }
                        break;
                    case 'Company':
                        if (transfereeType== 'Individual'){
                            $('#companyIndividualconveyancing').addClass('hidden');
                            $("#companyTransferorIndividualconveyancing_data").removeClass('hidden');
                        }else if (transfereeType== 'Company'){
                            $('#individualCompanyconveyancing').addClass('hidden');
                            $("#companiesTransferorConveyancing_data").removeClass('hidden');
                        }
                        break;
                }
            });
            $("#client_info_transferee").on('click',function (){

                $('#client_info_transferor').hide();
                $('#transferor_client_info_clear').hide();

                let transferorType = $("#transferor_type :selected").text();
                let transfereeType = $("#transferee_type :selected").text();

                switch (transfereeType) {
                    case 'Individual':
                        if (transferorType == 'Individual'){
                            $('#individualsConveyancing').addClass('hidden');
                            $("#individualsTransfereeConveyancing_data").removeClass('hidden');

                        }else if (transferorType == 'Company'){
                            $('#companyIndividualconveyancing').addClass('hidden');
                            $("#individualTransfereeCompanyconveyancing_data").removeClass('hidden');
                        }
                        break;
                    case 'Company':
                        if (transferorType== 'Individual'){
                            $('#individualCompanyconveyancing').addClass('hidden');
                            $("#companyTransfereeIndividualconveyancing_data").removeClass('hidden');

                        }else if (transferorType== 'Company'){

                            $('#companiesConveyancing').addClass('hidden');
                            $("#companiesTransfereeConveyancing_data").removeClass('hidden');
                        }
                        break;
                }
            });

            $('#transferor_client_info_clear').on('click',function (){
                let clientType = $("#transferor_type :selected").text();

                $('#individualsTransferorConveyancing_data').addClass('hidden');
                $('#individualsTransfereeConveyancing_data').addClass('hidden');

                $('#companiesTransferorConveyancing_data').addClass('hidden');
                $('#companiesTransfereeConveyancing_data').addClass('hidden');

                $('#individualTransferorCompanyconveyancing_data').addClass('hidden');
                $('#individualTransfereeCompanyconveyancing_data').addClass('hidden');

                $('#companyTransferorIndividualconveyancing_data').addClass('hidden');
                $('#companyTransfereeIndividualconveyancing_data').addClass('hidden');

                $('#client_info_transferee').show();
                $('#transferee_client_info_clear').show();
                switch (clientType) {
                    case 'Individual':
                        $('#client_info_transferee').show();
                        $('#transferee_client_info_clear').show();
                        break;
                    case 'Company':
                        $('#client_info_transferee').show();
                        $('#transferee_client_info_clear').hide();
                        break;
                }

            });
            $('#transferee_client_info_clear').on('click',function (){

                $('#individualsTransferorConveyancing_data').addClass('hidden');
                $('#individualsTransfereeConveyancing_data').addClass('hidden');

                $('#companiesTransferorConveyancing_data').addClass('hidden');
                $('#companiesTransfereeConveyancing_data').addClass('hidden');

                $('#individualTransferorCompanyconveyancing_data').addClass('hidden');
                $('#individualTransfereeCompanyconveyancing_data').addClass('hidden');

                $('#companyTransferorIndividualconveyancing_data').addClass('hidden');
                $('#companyTransfereeIndividualconveyancing_data').addClass('hidden');

                let clientType = $("#transferee_type :selected").text();

                $('#client_info_transferor').show();
                $('#transferor_client_info_clear').show();
                switch (clientType) {
                    case 'Individual':
                        $('#client_info_transferor').show();
                        $('#transferor_client_info_clear').show();
                        break;
                    case 'Company':
                        $('#client_info_transferor').show();
                        $('#transferor_client_info_clear').show();
                        break;
                }
            });

            $('#litigationTable').DataTable( {
                processing: true,
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal( {
                            header: function ( row ) {
                                let data = row.data();
                                return 'Case Details for '+data[1];
                            }
                        } ),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                            tableClass: 'table'
                        } )
                    }
                },
                "displayLength": 10,
            } );
            $('#conveyanceTable').DataTable( {
                processing: true,
                "searching": true,
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal( {
                            header: function ( row ) {
                                let data = row.data();
                                return 'Conveyancing Details for '+data[1];
                            }
                        } ),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                            tableClass: 'table'
                        } )
                    }
                },
                "displayLength": 10,
            } );

            $('#conveyanceTable').on('click', '.dropdown-item', function (e) {
                e.preventDefault();

                let lawyerId = $(this).attr('id');
                let url = '{{ route("admin.conveyancing.update",["conveyancing"=> ":id"]) }}';
                let token = $('input[name="_token"]').val();
                let buttonAssign = this;

                $(buttonAssign).parents('.dropdown').find('.btn').html(
                    `<i class="fa fa-spinner fa-spin"></i> assigning...`);
                $(buttonAssign).parents(".dropdown").find('.btn').attr('disabled', true);
                const caseId = $(buttonAssign).closest('tr').find('td:nth-child(1)').text();
                url = url.replace(':id', caseId);

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        '_token' : token,
                        _method: 'PUT',
                        'user_id': lawyerId
                    },
                    success: function(response) {
                        window.location.reload();
                    },
                    error: function (response) {
                        console.log("error "+ response);
                    }
                });
            });
            $('#litigationTable').on('click', '.dropdown-item', function (e) {
                e.preventDefault();
                let lawyerId = $(this).attr('id');
                let url = '{{ route("admin.litigation.update",["litigation"=> ":id"]) }}';
                let token = $('input[name="_token"]').val();
                let buttonAssign = this;

                $(buttonAssign).parents('.dropdown').find('.btn').html(
                    `<i class="fa fa-spinner fa-spin"></i> assigning...`);
                $(buttonAssign).parents(".dropdown").find('.btn').attr('disabled', true);
                const caseId = $(buttonAssign).closest('tr').find('td:nth-child(1)').text();
                url = url.replace(':id', caseId);

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        '_token' : token,
                        _method: 'PUT',
                        'user_id': lawyerId
                    },
                    success: function(response) {
                        window.location.reload();
                    },
                    error: function (response) {
                        console.log("error "+ response);
                    }
                });
            });
            $('#conveyanceTable').on('click', '.delete', function(e){
                let el = this;
                e.preventDefault();

                // Delete id
                let client = $(this).data('id');
                bootbox.confirm({
                    title: "Delete Individual Conveyance?",
                    message: "Do you really want to delete this record?",
                    buttons: {
                        cancel: {
                            label: `<i class="fa fa-times"></i> Cancel`
                        },
                        confirm: {
                            label: `<i class="fa fa-check"></i> Confirm`
                        }
                    },
                    callback: function (result) {
                        let url = '{{ route("admin.conveyancing.destroy",["conveyancing"=> ":id"]) }}';
                        url = url.replace(':id', client);
                        if(result){
                            $(el).html(`<i class="fa fa-spinner fa-spin"></i> deleting...`);
                            // AJAX Request
                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: {
                                    '_token' : '{{ csrf_token() }}',
                                    _method: 'DELETE'
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
                                    // var table = $('#individual').DataTable();
                                    // table.row($(btn).parents('tr')).remove().draw(false); //c
                                    // window.location.reload();
                                },
                                error: function (response) {
                                    console.log("error "+ response.responseText);
                                }
                            });
                        }
                    }
                });
            });
            $('#litigationTable').on('click', '.delete', function(e){
                let el = this;
                e.preventDefault();

                // Delete id
                let client = $(this).data('id');
                bootbox.confirm({
                    title: "Delete Individual File?",
                    message: "Do you really want to delete this record?",
                    buttons: {
                        cancel: {
                            label: `<i class="fa fa-times"></i> Cancel`
                        },
                        confirm: {
                            label: `<i class="fa fa-check"></i> Confirm`
                        }
                    },
                    callback: function (result) {
                        let url = '{{ route("admin.litigation.destroy",["litigation"=> ":id"]) }}';
                        url = url.replace(':id', client);
                        if(result){
                            $(el).html(`<i class="fa fa-spinner fa-spin"></i> deleting...`);
                            // AJAX Request
                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: {
                                    '_token' : '{{ csrf_token() }}',
                                    _method: 'DELETE'
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
                                },
                                error: function (response) {
                                    console.log("error "+ response.responseText);
                                }
                            });
                        }
                    }
                });
            });


        } );
</script>
@endsection
