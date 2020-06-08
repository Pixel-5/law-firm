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
                        <table id="cases" class="table hover table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>File No</th>
                                <th>Case No</th>
                                <th>Client</th>
                                <th>Lawyer Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cases as $case)
                            <tr>
                                <td>{{ $case->id }}</td>
                                <td>{{ $case->file->number }}</td>
                                <td>{{ $case->number }}</td>
                                <td>{{ $case->file->name }} {{ $case->file->surname }}</td>
                                <td>{{ $case->user === null ? "":  $case->user->profile->username}}</td>
                                <td>
                                    @include('partials.dropdown-lawyers',[ 'user' => $case->user === null])
                                    <a class="btn btn-warning btn-sm  text-center text-white"
                                       href="{{ route('cases.show', $case->id ) }}">
                                        <i class="fa fa-pencil-alt"></i> Edit</a>
                                    <a class="delete btn btn-danger btn-sm text-center text-white"
                                    id="{{ $case->id }}"><i class="fa
                                    fa-trash"></i>
                                        Delete</a>
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
            let groupColumn = 1;

           $('#cases').DataTable( {
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

            $('#cases').on('click', '.dropdown-item', function () {

                let lawyerId = $(this).attr('id');
                let url = '{{ route("cases.update",["case"=> ":id"]) }}';
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
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        window.location.reload();
                        // $(buttonAssign).parents('.dropdown').find('.btn').html(`<i class="init-icon fa fa-user-circle"></i> Re-assign`);
                        // $(buttonAssign).parents('.dropdown').find('.btn').removeClass('btn-outline-info');
                        // $(buttonAssign).parents('.dropdown').find('.btn').addClass('btn-outline-success');
                        // $(buttonAssign).parents(".dropdown").find('.btn').attr('disabled', false);
                        // $('#status_alert').addClass('show');
                        // $('#status_alert').find('.status').text("Successfully assigned lawyer a case");
                    },
                    error: function (response) {
                        console.log("error "+ response);
                    }
                });
            });

        } );
    </script>
    @include('partials.case-delete-btn')
@endsection
