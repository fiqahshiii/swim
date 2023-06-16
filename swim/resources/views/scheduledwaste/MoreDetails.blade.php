@extends('layouts.sideNav')

@section('content')
<h4>Scheduled Waste</h4>
<h6>Print Report</h6>
<head>
    <style>
          @media print {
    /* Add your print-specific styles here */
    /* Hide any unnecessary elements */
    .hide-on-print {
      display: none;
    }
    /* Customize the appearance of printed elements */
    .card {
      border: 1px solid #000;
      padding: 10px;
      margin-bottom: 10px;
    }
    /* Adjust the layout for printing */
    /* Add any other necessary styles */
  }
  /* table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
} */
table {
         width: 150%;
         table-layout: fixed;
         border-collapse: collapse;
      }
            
      th, td {
         padding: 5px;
         text-align: left;
      }
            
      td {
         width: 150px;
      }
        </style>
</head>
<!-- message box if the new waste has been added -->
@if(session()->has('message'))
<div class="alert alert-success">    
    {{ session()->get('message') }}
</div>
@endif

@foreach($wastelist as $index => $data)

<div class="print-content">
<div class="card">
    <div class="card-body">
        <!-- form add waste -->
        <tr>
            <td>Person In Charge: </td>
            <td><img src="flexsys_logo.png" alt="Girl in a jacket"></td>
        </tr>
        <tr>
            <td>Person In Charge: </td>
            <td>{{$data->fullname}}</td>
        </tr>
        <table style="width:100%">
            <tr>
                <th style="text-align:center;" colspan="3">Scheduled Waste Details</th>
                
            </tr>
            <tr>
                <td>Waste Description</td>
                <td>{{$data->wastedescription}}</td>
                
            </tr>
            <tr>
                <td>Weight</td>
                <td>{{$data->weight}}</td>
               
            </tr>
            <tr>
                <td>Waste Type</td>
                <td>{{$data->wastetype}}</td>
               
            </tr>
            <tr>
                <td>Physical State</td>
                <td>{{$data->state}}</td>
               
            </tr>
            <tr>
                <td>Waste Generated</td>
                <td>{{$data->wasteDate}}</td>
               
            </tr>
            <tr>
                <td>Waste Expired Date</td>
                <td>{{$data->expiredDate}}</td>
               
            </tr>
            <tr>
                <td>Disposal Site</td>
                <td>{{$data->disposalsite}}</td>
               
            </tr>
            <tr>
                <td>Type of Packaging</td>
                <td>{{$data->packaging}}</td>
               
            </tr>
            </table><br>
            

            @foreach ($transporterlist as $trans)
            <table style="width:100%">
            <tr>
                <th style="text-align:center;" colspan="3">Transporter Details</th>
                
            </tr>
            <tr>
                <td>Name</td>
                
                <td>{{$trans->fullname}}</td>
                
                
            </tr>
            <tr>
                <td>Phone Number</td>
                <td>{{$trans->phonenum}}</td>
               
            </tr>
            <tr>
                <td>Email</td>
                <td>{{$trans->email}}</td>
               
            </tr>
            <tr>
                <td>Company Name</td>
                <td>{{$trans->companyname}}</td>
               
            </tr>
            <tr>
                <td>Remarks</td>
                <td>{{$trans->remarks}}</td>
               
            </tr>
            <tr>
                <td>Address</td>
                <td>{{$trans->address}}</td>
               
            </tr>
            <tr>
                <td>Registered Vehicle</td>
                <td>{{$trans->platenumber}}</td>
               
            </tr>
            </table><br>
            @endforeach

            @foreach ($receiverlist as $receiver)
            <table style="width:100%">
            <tr>
                <th style="text-align:center;" colspan="3">Receiver Details</th>
                
            </tr>
            <tr>
                <td>Name</td>
                
                <td>{{$receiver->fullname}}</td>
                
                
            </tr>
            <tr>
                <td>Phone Number</td>
                <td>{{$receiver->phonenum}}</td>
               
            </tr>
            <tr>
                <td>Email</td>
                <td>{{$receiver->email}}</td>
               
            </tr>
            <tr>
                <td>Company Name</td>
                <td>{{$receiver->companyname}}</td>
               
            </tr>
            <tr>
                <td>Remarks</td>
                <td>{{$receiver->remarks}}</td>
               
            </tr>
            <tr>
                <td>Address</td>
                <td>{{$receiver->address}}</td>
               
            </tr>
          
            </table><br>
            @endforeach
            
            <a class="btn btn-primary print hide-on-print" id="waste" style="float: right; color:white" href="" target="_blank">Print</a>

    </div>
</div><br>
</div>

@endforeach

<script type="text/javascript" src='https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js'></script>
<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!-- to preview the chosen file from computer -->
<!-- <script type="text/javascript">
    $(function() {
        $("#pdffile").change(function() {
            $("#dvPreview").html("");

            $("#dvPreview").show();
            $("#dvPreview").append("<iframe />");
            $("iframe").css({
                "height": "400px",
                "width": "450px"
            });
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#dvPreview iframe").attr("src", e.target.result);
            }
            reader.readAsDataURL($(this)[0].files[0]);
        });
    });
</script> -->

<!-- to avoid user choose the past date -->
<script>
    $(function() {
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;
        $('#txtDate').attr('min', maxDate);
    });
</script>
<script>
  $(function() {
    $('.print').click(function() {
      window.print();
    });
  });
</script>
@endsection
