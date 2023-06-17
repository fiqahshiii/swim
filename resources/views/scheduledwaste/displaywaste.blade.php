@extends('layouts.sideNav')

@section('content')
<h4>Scheduled Waste</h4>
<h6>Display Scheduled Waste</h6><br>
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
        </style>
</head>
<!-- message box if the new waste has been added -->
@if(session()->has('message'))
<div class="alert alert-success">    
    {{ session()->get('message') }}
</div>
@endif

<a href="{{ route('swlist') }}" style="color: white; background:#000066; border-radius: 3px; height:3px; 
padding: 5px 10px; text-decoration: none;" class="previous">&laquo; Previous</a><br><br>

@foreach($wastelist as $index => $data)
<div class="print-content">
<div class="card">
    <div class="card-body">
        <!-- form add waste -->
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>Waste Code</label>
                            <input type="text" name="wastecode" class="form-control" value="{{$data->wastecode}}" disabled>
                        </div>
                        </div>
                        <div class="col">
                            <label>Weight(mt)</label>
                            <input type="number" name="weight" class="form-control" value="{{$data->weight}}" disabled>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>Waste Description</label>
                            <input type="text" name="wastedescription" class="form-control" value="{{$data->wastedescription}}" disabled>
                        </div>
                        </div>
                        <div class="col">
                            <label>Disposal Site</label>
                            <input type="text" name="disposalsite" class="form-control" value="{{$data->disposalsite}}"disabled>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>Waste Type</label>
                            <input type="text" name="wastetype" class="form-control" value="{{$data->wastetype}}" disabled>
                        </div>
                        </div>
                        <div class="col">
                            <label>Type Of Packaging</label>
                            <input type="text" name="disposalsite" class="form-control" value="{{$data->packaging}}" disabled>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>Physical State</label>
                            <input type="text" name="disposalsite" class="form-control" value="{{$data->state}}" disabled>                      
                        </div>
                        </div>
                        <div class="col">
                            <label>Disposal Status</label>
                            <input type="text" name="disposalsite" class="form-control" value="{{$data->statusDisposal}}" disabled>

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label>Waste Generated Date</label>
                            <input type="date" name="wasteDate" class="form-control" id="txtDate" value="{{$data->wasteDate}}" disabled>
                        </div>
                        <div class="col">
                            <label>Person In Charge</label>
                            <input type="text" name="pic" class="form-control" placeholder="Person in Charge Name" value="{{$data->name}}" disabled>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label>Waste Expired Date</label>
                            <input type="date" name="expiredDate" class="form-control" id="txtDate" value="{{$data->expiredDate}}" disabled>
                        </div>
          
                        <div class="col">
                            <label>Transporter</label>
                             
                            <input type="text" name="transporter" class="form-control" value="{{ $data-> transporterName}}" disabled>
                            
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                        <label>Receiver</label>
                        <input type="text" name="companyreceiver" class="form-control" value="{{ $data->companyname}}" disabled>
                        </div>
                        
                        <div class="col">
                        <label>Approval</label>
                        <input type="text" name="approval" class="form-control" value="{{$data->approval}}" disabled>
                         </div>
                    </div>
                    <br>
                </div> 
            </div><br>
            <a class="btn btn-primary" id="waste" style="float: right; color:white; background:#000066;" 
            href="{{ route('editwaste',['swListID' => $data->swListID, 'transID' => $data->transID, 'receiveID' => $data->receiveID ]) }}">Edit</a>

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
