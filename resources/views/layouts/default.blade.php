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
                @if(Session::has('fail'))
                    <div class="container-fluid">
                        <div class="alert  alert-danger alert-dismissible fade {{ Session::has('status')? 'show':'hide' }}"
                             role="alert" id="status_alert">
                            <strong class="status">Alert!</strong>
                            {{  Session::get('fail') }}
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
@include('partials.logout-modal')
@include("layouts.scripts")
@yield('custom-scripts')
<script type="application/javascript">
    $(document).ready(function () {

        var conveyancing_labels;
        var litigation_labels;
        var ctx;
        var max;
        var url;
        var myBarChart;
        var labels;
        var litigation_data;
        var conveyancing_data;
        $(".alert-dismissible").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert-dismissible").alert('close');
        });

        // $(".btn-primary").on('click', function () {
        //     $(this).attr('disabled', true);
        //     $(this).closest('form').submit();
        //     $(this).html(
        //         `<i class="fa fa-spinner fa-spin"></i> loading...`);
        // });

        // $(".btn-danger").on('click', function () {
        //     $(this).attr('disabled', true);
        //     $(this).closest('form').submit();
        //
        // });

        // $(".btn-secondary").on('click', function () {
        //     $(this).attr('disabled', true);
        //     $(this).closest('form').submit();
        //     $(this).html(
        //         `<i class="fa fa-spinner fa-spin"></i> updating...`);
        // });

        $(".loader").addClass("hidden");
        litigation_labels = [];
        litigation_data = [];
        conveyancing_data = [];
        conveyancing_labels = [];
        max =0;
        // Bar Chart Example
        url = '{{ route(auth()->user()->roles->first()->title === 'Lawyer'? 'lawyer.chart':'admin.chart') }}';
        $.ajax({
            url: url,
            method: 'GET',
            success: function(response) {
                var conveyancing;
                var labels;
                let month;
                const litigation = response.litigation;
                if (!Array.isArray( litigation)){
                    const lastLitigationYearKey = Object.keys(litigation).sort().reverse()[0];
                    let lastLitigationValue = litigation[lastLitigationYearKey];
                    //sortByMonth(lastLitigationValue.months);
                    for (const key in lastLitigationValue.months) {
                        month = lastLitigationValue.months[key];
                        litigation_labels.push(month.name);
                        litigation_data.push(month.value);
                    }
                    max = lastLitigationValue.total_cases;
                }

                conveyancing = response.conveyancing;
                console.log(Array.isArray( conveyancing));
                if (!Array.isArray( conveyancing)){
                    const lastConveyancingYearKey = Object.keys(conveyancing).sort().reverse()[0];
                    let lastConveyancingValue = conveyancing[lastConveyancingYearKey];

                    // sortByMonth(lastConveyancingValue.months);
                    if (lastConveyancingValue !== null || lastConveyancingValue != undefined){
                        for (const key in lastConveyancingValue.months) {
                            month = lastConveyancingValue.months[key];
                            conveyancing_labels.push(month.name);
                            conveyancing_data.push(month.value);
                        }
                    }
                    max = Math.max(max, lastConveyancingValue.total_cases);
                }

                ctx = document.getElementById("casesBarChart");
                labels = [...new Set([...litigation_labels ,...conveyancing_labels])];
                myBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                            "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                        datasets: [
                            {
                                label: "# of Litigation",
                                backgroundColor: "#4e73df",
                                hoverBackgroundColor: "#2e59d9",
                                borderColor: "#4e73df",
                                data: litigation_data,
                            },
                            {
                                label: "# of Conveyancing",
                                backgroundColor: "#FF5733",
                                hoverBackgroundColor: "#CB3B1C",
                                borderColor: "#E15E42",
                                data: conveyancing_data,
                            }
                        ],
                    },
                    options: {
                        maintainAspectRatio: false,
                        responsive:true,
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
                                    max: max,
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
                            },
                            ],
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
