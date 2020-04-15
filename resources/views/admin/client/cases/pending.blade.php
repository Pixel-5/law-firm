@extends('layouts.default')

@section('custom-links')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- Custom styles for this page -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('breadcrumb')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pending cases</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
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
                                    <th>Case No</th>
                                    <th>Client Name</th>
                                    <th>Assigned Lawyer</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @inject('cases','App\Repository\CaseRepositoryInterface')
                                @foreach ($cases->pendingCases() as $case)
                                    <tr>
                                        <td>{{ $case->number }}</td>
                                        <td>{{ $case->name }}</td>
                                        <td>{{ $case->user->name }}</td>
                                        <td>
                                            <span class="badge badge-warning">Pending</span>
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
    </div>
    <!-- /.container-fluid -->
@endsection

@section('custom-scripts')
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/responsive.bootstrap4.min.js') }}"></script>
    <!-- Page level plugins -->
    <script src="{{ asset('js/bootbox.min.js') }}"></script>
    <script type="application/javascript">
        $(document).ready(function() {
            $('#example').DataTable( {
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
        } );
    </script>
@endsection
