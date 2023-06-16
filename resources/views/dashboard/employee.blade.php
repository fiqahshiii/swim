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
        <div id="columnchart_material" style="width: 800px; height: 500px;"></div>
        </div>
    </div>
    </div>

    <div class="col-sm-4"> 
    <div class="card" style="height: 300px;">
        <div class="card-body">
            <h5 class="card-title">Status of Scheduled Waste</h5>
        </div>
    </div>
    </div>   
</div><br>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['', 'Total Transporter', 'Available', 'Non-Available'],
      ['Transporter', {{ $countTransporter }}, {{ $countAvailTrans }}, {{ $countNonAvailTrans }}]
    ]);

    var options = {
      chart: {
        title: 'Total Transporter',
        subtitle: '',
      },
      width: 550, // Set the desired width
      height: 400 // Set the desired height
    };

    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
  }
</script>



@endsection