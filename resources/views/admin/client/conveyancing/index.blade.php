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
                <li class="breadcrumb-item active" aria-current="page">Conveyancing</li>
                <li class="offset-11 d-sm-block" style="height: 10px;margin-top: -30px;">
                    <a href="{{ url()->previous()}}" title="Back">
                        <i class="fa fa-2x fa-chevron-circle-left"></i>
                    </a>
                </li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="row">
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- DataTales Example -->
            <input type="hidden" name="_token" value="{{ @csrf_token() }}">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="conveyanceTable" class="table hover table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Plot No</th>
                                <th>Transaction Type</th>
                                <th>Other Type</th>
                                <th>Attorney</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($conveyancing as $conveyance)
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
                                                        @switch(class_basename($conveyance->client->clientable))
                                                            @case('Individual')
                                                                <x-individualForm :file="$conveyance->client->clientable"/>
                                                            @break
                                                        @endswitch
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
                                        @can('case_access')
                                            <a class="btn btn-info btn-sm  text-center text-white"
                                               href="{{ route('client.show', $conveyance->id) }}">
                                                <i class="fa fa-eye"></i> view</a>
                                        @endcan
                                        @can('case_access')
                                            @include('partials.dropdown-lawyers',[ 'user' => $conveyance->user])
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
        <!-- /.container-fluid -->
    </div>
@endsection

@section('custom-scripts')
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/bootbox.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/responsive.bootstrap4.min.js') }}"></script>
   <script>
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
                               console.log("error "+ response);
                           }
                       });
                   }
               }
           });
       });
   </script>
@endsection
