@extends('layouts.sideNav')
@section('content')

<!-- Page Header -->
<div class="page-header row no-gutters pb-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0 d-flex">
        <h1 class="page-title ml-3">Employee Overview</h1>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <h5 class="card-title" style="font-size: 30px;">{{$countDisposedSW}}</h5>
                    </div>
                    <div class="col-sm-8">
                        <h5 class="card-title">Total Disposed Scheduled Waste</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <h5 class="card-title" style="font-size: 30px;">{{$countPendingSW}}</h5>
                    </div>
                    <div class="col-sm-8">
                        <h5 class="card-title">Pending Scheduled Waste</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <h5 class="card-title" style="font-size: 30px;">{{$countTotalSW}}</h5>
                    </div>
                    <div class="col-sm-8">
                        <h5 class="card-title">Total Scheduled Waste</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><br>

<div class="row">
    <div class="col-sm-8">
        <div class="card">
            <div class="card-body">
                <div id="columnchart_material" style="width: 800px; height: ;"></div>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="card" style="height: 300px;">
            <div class="card-body">
                <h5 class="card-title">Scheduled Waste Approval</h5>
                <div id="donutchart"></div>
            </div>
        </div>
    </div>
</div><br>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts() {
        var donutData = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Approve',     {{ $countApproveSW }}],
            ['In-progress',     {{ $countinprogressSW }}],
            ['Reject',     {{ $countRejectSW }}]
        ]);

        var donutOptions = {
            title: '',
            pieHole: 0.2,
        };

        var donutChart = new google.visualization.PieChart(document.getElementById('donutchart'));
        donutChart.draw(donutData, donutOptions);

        var columnData = google.visualization.arrayToDataTable([
            ['', 'Transporter', 'Available', 'Non-Available',  'Receiver'],
            ['Consignment', {{ $countTransporter }}, {{ $countAvailTrans }}, {{ $countNonAvailTrans }}, {{ $countReceiver }}]
        ]);

        var columnOptions = {
            chart: {
                title: 'Total Consignment',
                subtitle: '',
            },
            width: 550, // Set the desired width
            height: 400 // Set the desired height
        };

        var columnChart = new google.charts.Bar(document.getElementById('columnchart_material'));
        columnChart.draw(columnData, columnOptions);
    }
</script>
@endsection
