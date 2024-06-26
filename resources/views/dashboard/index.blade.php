@extends('layouts.master')
@section('title')
    Dashboard
@endsection

@section('content')
    {{-- greetings based on real-time --}}
    <?php
    $hour = date('G');
    $minute = date('i');
    $second = date('s');
    $msg = ' Today is ' . date('l, M. d, Y.') . ' And the time is ' . date('g:i a');
    
    if ((int) $hour == 1 && (int) $hour <= 9) {
        $greet = 'Good Morning,';
    } elseif ((int) $hour >= 10 && (int) $hour <= 11) {
        $greet = 'Good Day,';
    } elseif ((int) $hour >= 12 && (int) $hour <= 15) {
        $greet = 'Good Afternoon,';
    } elseif ((int) $hour >= 16 && (int) $hour <= 23) {
        $greet = 'Good Evening,';
    } else {
        $greet = 'Welcome,';
    }
    ?>
    <h5 class="my-3"> <?php echo $greet; ?> {{ auth()->user()->first_name }} !</h5>
    {{-- //// --}}

    {{-- <h5 class="my-2"> Overview Report</h5> --}}
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-m font-weight-bold text-danger text-uppercase mb-1">
                                Total data report</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @foreach ($reportInventary_sum as $item)
                                    {{ $item->all }} <small class="text-muted text-gray-500">(All Data Problem)</small>
                                @endforeach
                                @php
                                    $report_handled = $dataItem->where('status', '1')->count();
                                @endphp
                                <p class="m-0">{{ $report_handled }} <small class="text-muted text-gray-500">Report
                                        Handled</small>
                                </p>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-m font-weight-bold text-danger text-uppercase mb-1">
                                Service Type
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        @php
                                            $self_serviceCount = $dataItem
                                                ->where('service_type', 'Self Service')
                                                ->count();
                                            $vendorCount = $dataItem->where('service_type', 'Vendor')->count();
                                        @endphp
                                        <p class="m-0">{{ $self_serviceCount }} <small
                                                class="text-muted text-gray-500">Self Service</small></p>
                                        <p class="m-0">{{ $vendorCount }} <small
                                                class="text-muted text-gray-500">Vendor</small></p>
                                    </div>
                                </div>
                                {{-- <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-m font-weight-bold text-success text-uppercase mb-1">
                                TOTAL DATA INVENTARY</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @foreach ($dataInventary_sum as $item)
                                    <p> {{ $item->all }}</p>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-m font-weight-bold text-warning text-uppercase mb-1">
                                Total Department</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @foreach ($total_department as $department)
                                    <p> {{ $department->all }}</p>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- BAGIAN CHART BASED ON REPORT PER DEPARTMENT --}}
    <div class="row">
        <div class="col-xl-6 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartReportDept" style="width:100%;max-width:600px"></canvas>
                        <script>
                            var xValues = <?php echo json_encode($xValues); ?>;
                            var yValues = <?php echo json_encode($yValues); ?>;
                            var barColors = ["#4e73df", "#1cc88a", "#36b9cc", "#f6c23e", "#e74a3b"];

                            new Chart("chartReportDept", {
                                type: "bar",
                                data: {
                                    labels: xValues,
                                    datasets: [{
                                        backgroundColor: barColors,
                                        data: yValues
                                    }]
                                },
                                options: {
                                    legend: {
                                        display: false
                                    },
                                    title: {
                                        display: true,
                                        text: "MOST REPORTS BASED ON DEPARTMENT"
                                    },
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartReportCtg" style="width:100%;max-width:600px"></canvas>
                        <script>
                            var xCtgValues = <?php echo json_encode($xCtgValues); ?>;
                            var yCtgValues = <?php echo json_encode($yCtgValues); ?>;
                            var barColors = ["#e74a3b"];

                            new Chart("chartReportCtg", {
                                type: "bar",
                                data: {
                                    labels: xCtgValues,
                                    datasets: [{
                                        backgroundColor: barColors,
                                        data: yCtgValues
                                    }]
                                },
                                options: {
                                    legend: {
                                        display: false
                                    },
                                    title: {
                                        display: true,
                                        text: "MOST REPORTS BASED ON INVENTARY CATEGORIES"
                                    },
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartReportLinesMonthly" style="width:100%;max-width:600px"></canvas>
                        <script>
                            var ctx = document.getElementById('chartReportLinesMonthly').getContext('2d');
                            var dates = @json($dates);
                            var reports = @json($reports);

                            var myChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: dates,
                                    datasets: [{
                                        label: 'Laporan',
                                        data: reports,
                                        fill: false,
                                        borderColor: 'rgb(75, 192, 192)',
                                        tension: 0.1
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    },
                                    title: {
                                        display: true,
                                        text: "REPORT GRAPH IN THE LAST 3 MONTHS"
                                    },
                                },
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartInventaryCondition" style="width:100%;max-width:600px"></canvas>
                        <script>
                            var ctx = document.getElementById('chartInventaryCondition').getContext('2d');
                            var data = @json($conditions);

                            var labels = data.map(function(item) {
                                return item.condition;
                            });

                            var counts = data.map(function(item) {
                                return item.total;
                            });

                            var myChart = new Chart(ctx, {
                                type: 'horizontalBar',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'Jumlah Inventaris',
                                        data: counts,
                                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        x: {
                                            beginAtZero: false,
                                        },
                                        y: {
                                            beginAtZero: true
                                        },
                                    },
                                    title: {
                                        display: true,
                                        text: "TOTAL INVENTARY BY LATEST CONDITIONS"
                                    },
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
