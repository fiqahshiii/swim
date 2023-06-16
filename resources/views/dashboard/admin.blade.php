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
                <h5 class="card-title"style="font-size: 30px;">{{$countEmployee}}</h5>
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
                <h5 class="card-title"style="font-size: 30px;">{{$countTransporter}}</h5>
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
                <h5 class="card-title"style="font-size: 30px;">{{$countReceiver}}</h5>
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
                <div id="donutchart" style="width: 550px; height: 500px;"></div>
        </div>
    </div>
    </div>

    <div class="col-sm-4"> 
    <div class="card" style="height: 300px;">
        <div class="card-body">
            <h5 class="card-title">NUR AFIQAH BINTI MOHAMMDE JMIAL</h5>
        </div>
    </div>
    </div>

    
</div><br>



</div>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);

        var options = {
          title: 'Scheduled Waste Status',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>          

</script>


@endsection