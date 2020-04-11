<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('js/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

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
            <!-- Topbar -->
        @include("admin.top-nav-bar")
        <!-- End of Topbar -->
            <div class="container-fluid">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.files.index') }}">
                                {{ $file->number }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cases</li>
                    </ol>
                </nav>
            </div>
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <div class="alert alert-info fade show" role="alert">
                    <strong>Client has {{ $file->cases->count() }} cases recorded!</strong> Click the button to register a new case.
                    <a href="#" class="btn btn-md btn-outline-primary shadow-sm" data-toggle="modal" data-target="#openClientCaseModal">
                        <i class="fa fa-file-contract fa-sm text-dark-100"></i> open a new case</a>
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
                                    <form method="POST" action="{{ route('admin.cases.store') }}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group ">
                                            <label for="inputCaseNumber">Case Number</label>
                                            <input type="text" class="form-control" disabled
                                                   value="{{ \Illuminate\Support\Str::caseNumber() }}">
                                            <input type="hidden" name="number" class="form-control"
                                                   id="number"  value="{{ \Illuminate\Support\Str::caseNumber() }}">
                                            <input type="hidden" name="file_id" class="form-control"
                                                   id="file_id"  value="{{ $file->id }}">
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
                                                      rows="10" cols="50"  required>
                                            </textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="DateAppeal">Date of Appeal</label>
                                                <input type="date" class="form-control"
                                                       id="date_appeal" required name="date_appeal"
                                                       required>
                                            </div>
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
                </div>
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
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
{{--                    <div class="card shadow mb-4">--}}
{{--                        <!-- Card Header - Accordion -->--}}
{{--                        <a href="#collapseCardExample1" class="d-block card-header py-3" data-toggle="collapse"--}}
{{--                           role="button" aria-expanded="true" aria-controls="collapseCardExample">--}}
{{--                            <h6 class="m-0 font-weight-bold text-primary">Case ASBI-21--}}
{{--                                <span class="badge badge-success ">Done</span></h6>--}}

{{--                        </a>--}}
{{--                        <!-- Card Content - Collapse -->--}}
{{--                        <div class="collapse hide" id="collapseCardExample1">--}}
{{--                            <div class="card-body">--}}
{{--                                This is a collapsable card example using Bootstrap's built in collapse functionality. <strong>Click on the card header</strong> to see the card body collapse and expand!--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card shadow mb-4">--}}
{{--                        <!-- Card Header - Accordion -->--}}
{{--                        <a href="#collapseCardExample2" class="d-block card-header py-3" data-toggle="collapse"--}}
{{--                           role="button" aria-expanded="true" aria-controls="collapseCardExample">--}}
{{--                            <h6 class="m-0 font-weight-bold text-primary">Case ASBI-22--}}
{{--                                <span class="badge badge-warning ">Not Assigned</span>--}}
{{--                            </h6>--}}

{{--                        </a>--}}

{{--                        <!-- Card Content - Collapse -->--}}
{{--                        <div class="collapse hide" id="collapseCardExample2">--}}
{{--                            <div class="card-body">--}}
{{--                                This is a collapsable card example using Bootstrap's built in collapse functionality. <strong>Click on the card header</strong> to see the card body collapse and expand!--}}
{{--                                <div class="dropdown">--}}
{{--                                    <button class="btn btn-secondary  btn-sm dropdown-toggle float-right" type="button"--}}
{{--                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                        Assign Lawyer--}}
{{--                                    </button>--}}
{{--                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
{{--                                        <a class="dropdown-item" href="#">Action</a>--}}
{{--                                        <a class="dropdown-item" href="#">Another action</a>--}}
{{--                                        <a class="dropdown-item" href="#">Something else here</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    @foreach($file->cases as $case)
                        <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                        <a href="#{{ $case->number }}" class="d-block card-header py-3" data-toggle="collapse"
                           role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">Case {{ $case->number }}
                                <span class="badge badge-info ">{{ $case->status }}</span>
                            </h6>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse hide" id="{{ $case->number }}">
                            <div class="card-body">
                                <div class="jumbotron jumbotron-fluid">
                                    <div class="container">
                                        <h4 class="font-weight-bold">Court Case Information</h4>
                                        <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
                                    </div>
                                </div>
                                <div class="row">
                                   <div class="col-md-2 col-sm-6">
                                       <div class="d-flex p-2 font-weight-bold">
                                           <h5>Defendant: <span> {{ $case->defendant }}</span>
                                           </h5>
                                       </div>
                                   </div>
                                    <div class="col-md-1 col-sm-2">
                                        <div class="d-flex p-2 font-weight-bold">
                                            VS
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-6">
                                        <div class="d-flex p-2 font-weight-bold">
                                            <h5>Plaintiff: <span> {{ $case->plaintiff }}</span>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-md-7 align-items-end">
                                       <div class="d-sm-none d-md-block p-2" style="float: right;">
                                           <div class="d-block p-2 font-weight-bold offset-1">Supporting Docs</div>
                                           <ul>
                                               @foreach(explode(",", $case->docs) as $doc)
                                                   <div class="alert alert-sm-light  alert-dismissible fade show"
                                                        role="alert" style="height: 20px">
                                                       <li class="" style="margin: 0;"><a href="#">{{ $doc }}</a>
                                                           <button type="button" class="close" data-dismiss="alert"
                                                                   aria-label="Close">
                                                               <span aria-hidden="true" style="color: red;">&times;</span>
                                                           </button>
                                                        </li>
                                                    </div>
                                                   @endforeach
                                           </ul>
                                       </div>
                                    </div>
                                </div>
                                <div class="row">
                                   <div class="col-md-4"></div>
                                </div>
                                <div class="d-flex p-2 font-weight-bold"><h5>Case Details</h5></div>
                                <div class="d-flex p-2">
                                    {{ $case->details }}
                                </div>
                                <div class="clearfix"></div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <button class="btn btn-info btn-sm  text-center text-white"
                                                href="{{ route('admin.cases.show', $case->id) }}">
                                            <i class="fa fa-file-contract"></i> Edit Case
                                        </button>
                                        <button class="delete btn btn-danger btn-sm  text-center text-white"
                                                data-toggle="modal" data-target="#">
                                            <i class="fa fa-trash"></i> Delete Case
                                        </button>
                                        <a class="btn btn-outline-success btn-sm  text-center
                                                    dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                           data-toggle="dropdown" aria-haspopup="true"
                                           aria-expanded="false"><i class="fa fa-user-circle">
                                            </i> Assign</a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="#">Lawyer 1</a>
                                            <a class="dropdown-item" href="#">Lawyer 2</a>
                                            <a class="dropdown-item" href="#">lawyer 3</a>
                                        </div>
                                        <button class="attach btn btn-secondary btn-sm text-center text-white"
                                                id="{{ $case->id }}"
                                                data-id='{{ $case->id }}'>
                                            <i class="fa fa-paperclip"></i> Attach Docs
                                        </button>
                                    </div>
                                    <div class="col-md-6 align-items-end">
                                        <div class="d-flex p-2 font-weight-bold" style="float: right;">
                                            <span >Date of Court Appeal:  {{ $case->date_appeal }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
    @include("footer")
    <!-- End of Footer -->

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

<!-- Page level plugins -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
<script src="{{ asset('js/demo/chart-bar-demo.js') }}"></script>
</body>

</html>
