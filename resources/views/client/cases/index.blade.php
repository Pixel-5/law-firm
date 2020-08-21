@extends('layouts.default')
<!--  Content -->
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
                    <a href="#" class="btn btn-md btn-outline-primary shadow-sm" style="font-size: 14px;" data-toggle="modal" data-target="#openClientCoveyanceModal">
                        <i class="fa fa-file-pdf fa-sm text-dark-100"></i> Conveyance
                    </a>
                    @can('file_edit')
                        <a href="#" class="btn d-sm-block btn-outline-secondary shadow-sm float-right" data-toggle="modal" data-target="#openClientCaseModal">
                            <i class="fa fa-pencil-alt fa-sm text-dark-100"></i> Edit</a>
                    @endcan
                </div>

                <!-- Modal -->
                <div class="modal fade" id="openClientCaseModal" tabindex="-1" role="dialog"
                     aria-labelledby="openClientCaseModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="openClientCaseModalLabel">Court Case Information</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-primary" role="alert">
                                    In the High Court of the Republic of Botswana
                                </div>
                                <form method="POST" action="{{ route('cases.store') }}"
                                      enctype="multipart/form-data">
                                    @honeypot
                                    @csrf
                                    <div class="form-group ">
                                        <label for="inputCaseNumber">Case Number</label>
                                        <input type="text" class="form-control" disabled
                                               value="{{ \Illuminate\Support\Str::caseNumber() }}">
                                        <input type="hidden" name="number" class="form-control"
                                               id="number"  value="{{ \Illuminate\Support\Str::caseNumber() }}">
                                        <input type="hidden" name="file_id" class="form-control"
                                               id="file_id"  value="{{ $file->clientable->id }}">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputPlaintiffName">Plaintiff Name</label>
                                        <input type="text" class="form-control" id="plaintiff" name="plaintiff"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDefendantName">Defendant Name</label>
                                        <input type="text" class="form-control" id="defendant" name="defendant"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDetails">Case Details</label>
                                        <textarea class="form-control text-left" aria-label="With textarea" name="details"
                                                  rows="10" cols="50"  required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="validatedCustomFile"
                                                   name="docs[]" multiple>
                                            <label class="custom-file-label"
                                                   for="validatedCustomFile">Upload Supporting
                                                Docs...</label>
                                            <div class="invalid-feedback">Scan Supporting Documents</div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save case</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="openClientCoveyanceModal" tabindex="-1" role="dialog"
                     aria-labelledby="openClientCoveyanceModal" aria-hidden="true">
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
                                @include('client.file.individual.conveyance_form',['file'=>$file->clientable])
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
                    <span class="badge badge-primary">10</span></h5>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse hide" id="collapseCardExample1">
                <div class="card-body">
                    <div class="table-responsive">
                        <input type="hidden" name="_token" value="{{ @csrf_token() }}">
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
                       <table id="conveyance" class="table table-striped table-bordered nowrap" style="width:100%">
                           <thead>
                           <tr>
                               <th>#</th>
                               <th>Plot No</th>
                               <th>Transaction Type</th>
                               <th>Client</th>
                               <th>Other</th>
                               <th>Other Type</th>
                               <th>Action</th>
                           </tr>
                           </thead>

                           <tbody>

                           @foreach($file->conveyancing as $conveyance)
                               <tr>
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
                                                       <x-individualForm
                                                           :file="$conveyance"
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
                                   <td>{{ $conveyance->id }}</td>
                                   <th>{{ $conveyance->transaction->plot->plot_no }}</th>
                                   <td>{{ $conveyance->transaction->transaction_type }}</td>
                                   <td>{{ $conveyance->transaction->client_transaction_type }}</td>
                                   <th>{{ $conveyance->transaction->other_transaction_type }}</th>
                                   <th>{{ $conveyance->other_type }}</th>
                                   <td>
                                       @can('case_access')
                                           <a class="btn btn-info btn-sm  text-center text-white"
                                              href="{{ route('admin.client.show', $conveyance->id) }}">
                                               <i class="fa fa-file-contract"></i> view</a>
                                       @endcan
                                           @can('case_access')
                                               <a class="btn btn-primary btn-sm  text-center text-white"
                                                  href="{{ route('admin.client.show', $conveyance->id) }}">
                                                   <i class="fa fa-file-contract"></i> assign</a>
                                           @endcan
                                       @can('file_edit')
                                           <a class="btn btn-warning btn-sm  text-center text-white"
                                              data-toggle="modal" data-target="#editClientFileModal{{ $conveyance->id }}">
                                               <i class="fa fa-pencil-alt"></i> Edit</a>
                                       @endcan
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
    <script src="{{ asset('js/bootbox.min.js') }}"></script>
    <script type="application/javascript">
        $(document).ready(function() {

            $('.dropdown-item').on('click', function(){
            $("html, body").animate({
                scrollTop: $(
                    'html, body').get(0).scrollHeight
            }, 2000);

            let userId = $(this).attr('id');
            let caseId = '{{ $case->id ?? null }}';
            let url = '{{ route("cases.update",["case"=> ":id"]) }}';
            let token = $('input[name="_token"]').val();
            let buttonAssign = this;
            $(buttonAssign).parents('.dropdown').find('.btn').html(
                `<i class="fa fa-spinner fa-spin"></i> assigning...`);
            $(buttonAssign).parents(".dropdown").find('.btn').attr('disabled', true);
            if(caseId)
            {
                url = url.replace(':id', caseId);
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        '_token' : token,
                        _method: 'PUT',
                        'user_id': userId
                    },
                    success: function(response){
                        console.log("Successfully updated client case");
                        window.location.reload();
                    },
                    error: function (response) {
                        console.log("error "+ response.data);
                    }
                });
            }
        });
            $('.delete').on('click', function () {
                let btn = this;
                $(btn).attr('disabled', true);
                let id = $(btn).attr('id');

            bootbox.confirm({
                    title: "Delete Case?",
                    message: "Do you really want to delete this record?",
                    buttons: {
                        cancel: {
                            label: '<i class="fa fa-times"></i> Cancel'
                        },
                        confirm: {
                            label: '<i class="fa fa-check"></i> Confirm'
                        }
                    },
                    callback: function (result) {
                        let url = '{{ route("admin.cases.destroy",["case"=> ":id"]) }}';
                        url = url.replace(':id', id);
                        if(result){
                            $(btn).html(
                                `<i class="fa fa-spinner fa-spin"></i> deleting...`);
                            // AJAX Request
                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: {
                                    '_token' : $('input[name="_token"]').val(),
                                    _method: 'delete'
                                },
                                success: function(response){
                                    console.log(response.status);
                                    window.location.reload();
                                    // $('#status_alert').find('strong.status').html(''+response.status);
                                },
                                error: function (response) {
                                    console.log("error "+ response.data);
                                }
                            });
                        }else{
                            $(btn).attr('disabled', false);
                        }
                    }
                });
        });
            $('#conveyance').on('click', '.delete', function(){
                var el = this;

                // Delete id
                let file = $(this).data('id');
                console.log('id = '+file);

                bootbox.confirm({
                    title: "Delete Individual FIle?",
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
                        let url = '{{ route("admin.individual.destroy",["individual"=> ":id"]) }}';
                        url = url.replace(':id', file);
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
                                    console.log("error "+ response);
                                }
                            });
                        }
                    }
                });
            });
            $('#conveyance').DataTable( {
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
                "columnDefs": [
                    { "visible": false, "targets": groupColumn },
                ],
                "displayLength": 10,
            } );
    } );
</script>
@endsection
