@extends('layouts.sideNav')
@section('content')

<!-- Page Header -->
<div class="page-header row no-gutters pb-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0 d-flex">
        <h1 class="page-title ml-3">Manager Overview</h1>
    </div>
</div>

<div class="row">
    
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <div class="row">
            <div class="col-sm-4">
                <h5 class="card-title"style="font-size: 30px;">{{$countDisposedSW}}</h5>
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
            <div class="card-body" style="padding: 40px; padding-bottom: 40px;">
                <div id="columnchart_material" style="width: 800px; height: ;"></div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card" style="height: 300px;">
            <div class="card-body">
                <h5 class="card-title">S.O.P Documents</h5>
                <div id="table_div" style="width: 800px; height: ;"></div>
            </div>
        </div>
    </div>
</div><br>



</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawCharts);
   
    function drawCharts() {

      var columnData = google.visualization.arrayToDataTable([
        ['', 'Transporter', 'Available', 'Non-Available', 'Receiver'],
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

    google.charts.load('current', {'packages':['table']});
    google.charts.setOnLoadCallback(drawTable);
      }
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);
        var columnChart = new google.charts.Bar(document.getElementById('columnchart_material'));
        columnChart.draw(columnData, columnOptions);

        function drawTable() {
        var tableData = new google.visualization.DataTable();
        tableData.addColumn('string', 'SWCode');
        tableData.addColumn('number', 'No.of Document');

        @foreach($wastelist as $data)
        tableData.addRows([
            ['{{ $data->swcode }}', {{ $data->file_count }}],
        ]);
    @endforeach

        var tableOptions = {
          showRowNumber: true,
          width: '100%',
          height: '100%'
        };

        var table = new google.visualization.Table(document.getElementById('table_div'));
        table.draw(tableData, tableOptions);
      }
    
</script>



<!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);

      function drawTable() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('number', 'Salary');
        data.addColumn('boolean', 'Full Time Employee');
        data.addRows([
          ['Mike',  {v: 10000, f: '$10,000'}, true],
          ['Jim',   {v:8000,   f: '$8,000'},  false],
          ['Alice', {v: 12500, f: '$12,500'}, true],
          ['Bob',   {v: 7000,  f: '$7,000'},  true]
        ]);

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
      }
    </script> -->
@endsection