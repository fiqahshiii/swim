@extends('layouts.sideNav')
@section('content')

<!-- Page Header -->
<div class="page-header row no-gutters pb-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0 d-flex">
        <h1 class="page-title ml-3">Admin Overview</h1>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="user-icon-circle" style="font-size: 35px;">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <h5 class="card-title">Total Users</h5>
                        <h5 class="card-title" style="font-size: 30px;">{{$countEmployee}}</h5>
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
                        <div class="user-icon-circle" style="font-size: 35px;">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <h5 class="card-title">Total Transporter</h5>
                        <h5 class="card-title" style="font-size: 30px;">{{$countTransporter}}</h5>
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
                        <div class="user-icon-circle" style="font-size: 35px;">
                            <i class="fas fa-warehouse"></i>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <h5 class="card-title">Total Receiver</h5>
                        <h5 class="card-title" style="font-size: 30px;">{{$countReceiver}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><br>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div id="table_div"></div>
            </div>
        </div>
    </div>
</div><br>

<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <div id="donutchart"></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <div id="columnchart_material" style="width: 100%; height: 400px;"></div>
            </div>
        </div>
    </div>
</div><br>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
google.charts.load('current', { packages: ['corechart', 'bar', 'table'] });
google.charts.setOnLoadCallback(drawCharts);

function drawCharts() {
    // Table
    var tableData = new google.visualization.DataTable();
    tableData.addColumn('string', 'SWCode');
    tableData.addColumn('number', 'No. of Document');

    @foreach($wastelist as $data)
    tableData.addRow(['{{ $data->swcode }}', {{ $data->file_count }}]);
    @endforeach

    var tableOptions = {
        showRowNumber: true,
        width: '100%',
        height: '100%',
    };

    var table = new google.visualization.Table(document.getElementById('table_div'));
    table.draw(tableData, tableOptions);

    // Donut Chart
    var donutData = google.visualization.arrayToDataTable([
        ['Task', 'Count'],
        ['Disposed', {{ $countDisposedSW }}],
        ['Pending', {{ $countPendingSW }}],
    ]);

    var donutOptions = {
        title: 'Scheduled Waste Approval',
        pieHole: 0.4,
    };

    var donutChart = new google.visualization.PieChart(document.getElementById('donutchart'));
    donutChart.draw(donutData, donutOptions);

    // Column Chart
    var columnData = google.visualization.arrayToDataTable([
        ['', 'Approved', 'Rejected', 'In-Progress'],
        ['Summary', {{ $countApproveSW }}, {{ $countRejectSW }}, {{ $countinprogressSW }}]
    ]);

    var columnOptions = {
        chart: {
            title: 'SW Approval Summary',
            subtitle: '',
        },
        width: '100%',
        height: 400,
        colors: ['blue', 'green', 'red'],
    };

    var columnChart = new google.charts.Bar(document.getElementById('columnchart_material'));
    columnChart.draw(columnData, columnOptions);
}
</script>

@endsection
