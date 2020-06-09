<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="author" content="">

    <title>@yield('title')</title>
    @include('layouts.links')
    @yield('custom-links')

</head>

<body id="page-top">
<div class="loader">
    <img src="{{ asset('img/loading.gif') }}" alt="Loading..." />
</div>
<!-- Page Wrapper -->
<div id="wrapper">

@if(in_array(Auth::user()->roles->first()->title,['Super','Admin']))
    @include("admin.side-nav-bar")
@else
    @include("lawyer.side-nav-bar")
@endif
<!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
        @include("layouts.top-nav-bar")
        <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                @hasSection('breadcrumb')
                    @yield('breadcrumb')
                @endif
                @if(Session::has('status'))
                  <div class="container-fluid">
                          <div class="alert  alert-success alert-dismissible fade {{ Session::has('status')? 'show':'hide' }}"
                               role="alert" id="status_alert">
                              <strong class="status">Alert!</strong>
                              {{  Session::get('status') }}
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
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
                <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById
                ('frm-logout').submit();">
                    Logout
                </a>
                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
</div>

@include('partials.logout-modal')
@include("layouts.scripts")
@yield('custom-scripts')
<script type="application/javascript">
    $(document).ready(function () {

        $(".alert-dismissible").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert-dismissible").alert('close');
        });

        $(".btn-primary").on('click', function () {
            $(this).attr('disabled', true);
            $(this).closest('form').submit();
            $(this).html(
                `<i class="fa fa-spinner fa-spin"></i> loading...`);
        });

        // $(".btn-danger").on('click', function () {
        //     $(this).attr('disabled', true);
        //     $(this).closest('form').submit();
        //
        // });

        $(".btn-warning").on('click', function () {
            $(this).attr('disabled', true);
            $(this).closest('form').submit();
            $(this).html(
                `<i class="fa fa-spinner fa-spin"></i> updating...`);
        });

        $(".loader").addClass("hidden");
        var ctx;
        var myBarChart;
        let labels = [];
        let data = [];

        function sortByMonth(arr) {

            var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            arr.sort(function(a, b){
                return months.indexOf(a.name)
                    - months.indexOf(b.name);
            });
        }
        // Bar Chart Example
        let url = '{{ route(auth()->user()->roles->first()->title === 'Lawyer'? 'lawyer.chart':'admin.chart') }}';
        $.ajax({
            url: url,
            method: 'GET',
            success: function(response) {
                const years = response.years;
                const lastYearKey = Object.keys(years).sort().reverse()[0];
                let lastValue = years[lastYearKey];
                sortByMonth(lastValue.months);

                for (const key in lastValue.months) {
                    const month = lastValue.months[key];
                    labels.push(month.name);
                    data.push(month.value);
                }
                ctx = document.getElementById("casesBarChart");
                myBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "# of Cases",
                            backgroundColor: "#4e73df",
                            hoverBackgroundColor: "#2e59d9",
                            borderColor: "#4e73df",
                            data: data,
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        layout: {
                            padding: {
                                left: 10,
                                right: 25,
                                top: 25,
                                bottom: 0
                            }
                        },
                        scales: {
                            xAxes: [{
                                time: {
                                    unit: 'month'
                                },
                                gridLines: {
                                    display: false,
                                    drawBorder: false
                                },
                                ticks: {
                                    maxTicksLimit: 12
                                },
                                maxBarThickness: 25,
                            }],
                            yAxes: [{
                                ticks: {
                                    min: 0,
                                    max: lastValue.total_cases,
                                    maxTicksLimit: 6,
                                    padding: 10,
                                    // Include a dollar sign in the ticks
                                    callback: function(value, index, values) {
                                        return number_format(value);
                                    }
                                },
                                gridLines: {
                                    color: "rgb(234, 236, 244)",
                                    zeroLineColor: "rgb(234, 236, 244)",
                                    drawBorder: false,
                                    borderDash: [2],
                                    zeroLineBorderDash: [2]
                                }
                            }],
                        },
                        legend: {
                            display: true
                        },
                        tooltips: {
                            titleMarginBottom: 10,
                            titleFontColor: '#6e707e',
                            titleFontSize: 14,
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            caretPadding: 10,
                            callbacks: {
                                label: function(tooltipItem, chart) {
                                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                    return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                                }
                            }
                        },
                    }
                });
            },
            error: function (response) {
                console.log(response);
            }
        });

    });
</script>
</body>

</html>
