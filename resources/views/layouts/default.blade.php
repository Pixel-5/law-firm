<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>
    @include('layouts.links')
    @yield('custom-links')

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        @include("admin.side-nav-bar")
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
            @include("admin.top-nav-bar")
            <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    @hasSection('breadcrumb')
                        @yield('breadcrumb')
                    @endif

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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        @hasSection('title')
                        <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                        @endif
                    </div>
                    @yield('content')
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
@include('partials.logout-modal')
@include("layouts.scripts")
@yield('custom-scripts')
</body>

</html>
