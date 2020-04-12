<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Dashboard</title>

    <!-- Custom fonts for this template -->
    <link href="{{ asset('js/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- Custom styles for this page -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.bootstrap4.min.css') }}" rel="stylesheet">

</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
@include("admin.side-nav-bar")
<!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
        @include("admin.top-nav-bar")
        <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="container-fluid">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Clients files</li>
                        </ol>
                    </nav>
                    @if(Session::has('status'))
                        <div class="alert  alert-success alert-dismissible fade show" role="alert">
                            <strong>Alert!</strong>  {{  Session::get('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if(Session::has('fail'))
                        <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                            <strong>Alert!</strong>  {{  Session::get('fail') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @error('email', 'name', 'contact')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Content Row -->
                <div class="row">
                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                   data-toggle="modal" data-target="#addClientFileModal">
                                    <i class="fasfa-file fa-sm text-white-50"></i> New Client File</a>

                                <!-- Modal -->
                                <div class="modal fade" id="addClientFileModal" tabindex="-1" role="dialog"
                                     aria-labelledby="clientModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.files.store') }}"
                                                  enctype="multipart/form-data" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="clientModalLabel">New Client File
                                                        Information</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="inputName">Name</label>
                                                            <input type="text" class="form-control" id="name"
                                                                   name="name">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="inputSurname">Surname</label>
                                                            <input type="text" class="form-control" id="surname"
                                                                   name="surname" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="inputEmail">Email</label>
                                                            <input type="email" class="form-control" id="email"
                                                                   name="email" required>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="inputContact">Contact</label>
                                                            <input type="tel" class="form-control"
                                                                   name="contact" id="contact" placeholder="+267"
                                                                   required>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <div class="form-group">
                                                                <label for="dob">Date of Birth</label>
                                                                <input type="date" class="form-control"
                                                                       name="dob" id="dob" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <div class="form-group">
                                                                <label for="gender">Gender</label>
                                                                <select class="form-control form-control-md"
                                                                        name="gender" required>
                                                                    <option disabled>Select</option>
                                                                    <option>Male</option>
                                                                    <option>Female</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputAddress">Physical Address</label>
                                                        <input type="text" class="form-control" id="physicalAddress"
                                                               name="physical_address" placeholder="1234 Main St">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputAddress2">Postal Address</label>
                                                        <input type="text" class="form-control"
                                                               name="postal_address" id="PostalAddress" >
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="custom-file">
                                                            <input type="file"
                                                                   name="docs[]" class="custom-file-input"
                                                                   id="validatedCustomFile" multiple>
                                                            <label class="custom-file-label" for="validatedCustomFile">
                                                                Upload supporting docs...</label>
                                                            <div class="invalid-feedback">Scan Supporting Documents</div>
                                                        </div>
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
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="_token" value="{{ @csrf_token() }}">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>File No</th>
                                            <th>Client Full Name</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>File No</th>
                                            <th>Client Full Name</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Action</th>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        @foreach($files as $file)
                                        <tr>
                                            <div class="modal fade" id="editClientFileModal" tabindex="-1"
                                                 role="dialog"
                                                 aria-labelledby="clientModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <form action="{{ route('admin.files.update',[$file->id]) }}"
                                                              enctype="multipart/form-data" method="POST">
                                                            @csrf
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
{{--                                                                <div class="form-group">--}}
{{--                                                                    <div class="custom-file">--}}
{{--                                                                        <input type="file"--}}
{{--                                                                               name="docs[]" class="custom-file-input"--}}
{{--                                                                               id="validatedCustomFile" multiple>--}}
{{--                                                                        <label class="custom-file-label" for="validatedCustomFile">--}}
{{--                                                                            Upload supporting docs...</label>--}}
{{--                                                                        <div class="invalid-feedback">Scan Supporting Documents</div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save file</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <td>{{ $file->number }}</td>
                                            <td>{{ $file->name }} {{ $file->surname }}</td>
                                            <td>{{ $file->email }}</td>
                                            <td>+267{{ $file->contact }}</td>
                                            <td>
                                                <a class="btn btn-info btn-sm  text-center text-white"
                                                   href="{{ route('admin.cases.show', $file->id) }}">
                                                    <i class="fa fa-file-contract"></i> Open</a>
                                                <a class="btn btn-warning btn-sm  text-center text-white"
                                                   data-toggle="modal" data-target="#editClientFileModal"><i class="fa
                                                fa-pencil-alt"></i> Edit</a>
                                                <button class="delete btn btn-danger btn-sm text-center text-white"
                                                   id="{{ $file->id }}"
                                                        data-id='{{ $file->id }}'>
                                                    <i class="fa fa-trash"></i>Delete</button>
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

        </div>
        <!-- End of Main Content -->

        @include("footer")

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="#">Logout</a>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript-->
<script src="{{ asset('js/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('js/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('js/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>


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
</body>
</html>
