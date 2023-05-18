@extends('layouts.sideNav')

@section('content')
<h4>Scheduled Waste</h4>
<h6>Display Scheduled Waste</h6>

<!-- message box if the new waste has been added -->
@if(session()->has('message'))
<div class="alert alert-success">   
    {{ session()->get('message') }}
</div>
@endif
@foreach($wastelist As $key=>$data)
<div class="card">
    <div class="card-body">
        <!-- form add waste -->
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>WASTE CODE</label>
                            <input type="text" name="wastecode" class="form-control" value="{{$data->wastecode}}" disabled>
                        </div>
                        </div>
                        <div class="col">
                            <label>WEIGHT (mt)</label>
                            <input type="number" name="weight" class="form-control" value="{{$data->weight}}" disabled>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>WASTE DESCRIPTION</label>
                            <input type="text" name="wastedescription" class="form-control" value="{{$data->wastedescription}}" disabled>
                        </div>
                        </div>
                        <div class="col">
                            <label>DISPOSAL SITE</label>
                            <input type="text" name="disposalsite" class="form-control" value="{{$data->disposalsite}}"disabled>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>WASTE TYPE</label>
                            <input type="text" name="wastetype" class="form-control" value="{{$data->wastetype}}" disabled>
                        </div>
                        </div>
                        <div class="col">
                            <label>TYPE OF PACKAGING</label>
                            <input type="text" name="disposalsite" class="form-control" value="{{$data->packaging}}" disabled>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>PHYSICAL STATE</label>
                            <input type="text" name="disposalsite" class="form-control" value="{{$data->state}}" disabled>                      
                        </div>
                        </div>
                        <div class="col">
                            <label>DISPOSAL STATUS</label>
                            <input type="text" name="disposalsite" class="form-control" value="{{$data->statusDisposal}}" disabled>

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label>WASTE GENERATED DATE</label>
                            <input type="date" name="wasteDate" class="form-control" id="txtDate" value="{{$data->wasteDate}}" disabled>
                        </div>
                        <div class="col">
                            <label>PERSON IN CHARGE</label>
                            <input type="text" name="pic" class="form-control" placeholder="Person in Charge Name" value="{{$data->pic}}" disabled>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label>WASTE EXPIRED DATE</label>
                            <input type="date" name="expiredDate" class="form-control" id="txtDate" value="{{$data->expiredDate}}" disabled>
                        </div>
                        @endforeach
          
                        <div class="col">
                            <label>TRANSPORTER</label>
                            <input type="text" name="transporter" class="form-control" value="{{ $data->transporter}}" disabled>
                         </div>
                    </div>
                    <br>
                </div> 
            </div>
            <a class="btn btn-primary" id="waste" style="float: right; color:white" href="{{ route('editwaste', $data->id) }}">Edit</a>
    </div>
</div>
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
@endsection
