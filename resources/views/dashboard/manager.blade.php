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
                  <div id="columnchart_material" style="width: 250px; height: ;"></div>
              </div>
          </div>
      </div>
      <div class="col-sm-4">
          <div class="card" style="height: 300px;">
              <div class="card-body">
                  <h5 class="card-title">S.O.P Documents</h5>
                  <div id="table_div" style="width: 250px; height: ;"></div>
              </div>
          </div>
      </div>
  </div><br>

  </div>

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart', 'bar', 'table', 'line']});
    google.charts.setOnLoadCallback(drawCharts);
   
    function drawCharts() {

        var columnData = google.visualization.arrayToDataTable([
            ['', 'Transporter', 'Available', 'Non-Available', 'Receiver'],
            ['Consignment', {{$countTransporter}}, {{$countAvailTrans}}, {{$countNonAvailTrans}}, {{$countReceiver}}]
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

        var tableData = new google.visualization.DataTable();
        tableData.addColumn('string', 'SWCode');
        tableData.addColumn('number', 'No.of Document');

        @foreach($wastelist as $data)
        tableData.addRows([
            ['{{$data->swcode}}', {{$data->file_count}}],
        ]);
        @endforeach

        var tableOptions = {
            showRowNumber: true,
            width: '100%',
            height: '100%'
        };

        var table = new google.visualization.Table(document.getElementById('table_div'));
        table.draw(tableData, tableOptions);

        var lineData = new google.visualization.DataTable();
        lineData.addColumn('number', 'Day');
        lineData.addColumn('number', 'Guardians of the Galaxy');
        lineData.addColumn('number', 'The Avengers');
        lineData.addColumn('number', 'Transformers: Age of Extinction');

        lineData.addRows([
            [1, 37.8, 80.8, 41.8],
            [2, 30.9, 69.5, 32.4],
            [3, 25.4, 57, 25.7],
            [4, 11.7, 18.8, 10.5],
            [5, 11.9, 17.6, 10.4],
            [6, 8.8, 13.6, 7.7],
            [7, 7.6, 12.3, 9.6],
            [8, 12.3, 29.2, 10.6],
            [9, 16.9, 42.9, 14.8],
            [10, 12.8, 30.9, 11.6],
            [11, 5.3, 7.9, 4.7],
            [12, 6.6, 8.4, 5.2],
            [13, 4.8, 6.3, 3.6],
            [14, 4.2, 6.2, 3.4]
        ]);

        var lineOptions = {
            chart: {
                title: 'Box Office Earnings in First Two Weeks of Opening',
                subtitle: 'in millions of dollars (USD)'
            },
            width: 900,
            height: 500,
            axes: {
                x: {
                    0: { side: 'top' }
                }
            }
        };

        var lineChart = new google.charts.Line(document.getElementById('line_top_x'));
        lineChart.draw(lineData, google.charts.Line.convertOptions(lineOptions));
    }
</script>
  @endsection