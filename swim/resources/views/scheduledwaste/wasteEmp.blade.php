@extends('layouts.sideNav')

@section('content')
<h4>Scheduled Waste</h4>
<h6>Add New Waste</h6>

<!-- message box if the new waste has been added -->
@if(session()->has('message'))
<div class="alert alert-success">   
    {{ session()->get('message') }}
</div>
@endif
<head>
    <style>
        .margin-right {
        margin-right: 10px !important;
    }
    </style>

<script>
$(document).ready(function(){
    $(".reset-btn").click(function(){
        $("#myForm").trigger("reset");
    });
});
</script>
</head>
<div class="card">
    <div class="card-body">
        
        <!-- form add waste -->
        <form method="POST" action="{{ route('insertnewwaste') }}" id="wasteform">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>WASTE CODE</label>
                            <input type="text" name="wastecode" class="form-control" placeholder="SW ***" required>
                        </div>
                        </div>
                        <div class="col">
                            <label>WEIGHT (mt)</label>
                            <input type="number" name="weight" class="form-control" placeholder="Weight" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>WASTE DESCRIPTION</label>
                            <input type="text" name="wastedescription" class="form-control" placeholder="Waste Description" required>
                        </div>
                        </div>
                        <div class="col">
                            <label>DISPOSAL SITE</label>
                            <input type="text" name="disposalsite" class="form-control" placeholder="Disposal Site" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>WASTE TYPE</label>
                            <input type="text" name="wastetype" class="form-control" placeholder="Waste type" required>
                        </div>
                        </div>
                        <div class="col">
                            <label>TYPE OF PACKAGING</label>
                            <select class="form-control" name="packaging">
                                    <option value="">TYPE OF PACKAGING</option>
                                    <option value="JumboBag">Jumbo Bag</option>
                                    <option value="IBC">IBC</option>
                                    <option value="Drum">Drum</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>PHYSICAL STATE</label>
                            <select class="form-control" name="state">
                                    <option value="">PHYSICAL STATE</option>
                                    <option value="Solid">Solid</option>
                                    <option value="Gas">Gas</option>
                                    <option value="Liquid">Liquid</option>
                            </select>                       
                        </div>
                        </div>
                        <div class="col">
                            <label>DISPOSAL STATUS</label>
                            <select class="form-control" name="statusDisposal">
                                    <option value="">DISPOSAL STATUS</option>  
                                    <option value="Disposed">Disposed</option>
                                    <option value="Pending">Pending</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label>WASTE GENERATED DATE</label>
                            <input type="date" name="wasteDate" class="form-control" id="wasteDate" required>
                        </div>
                        <div class="col">
                            <label>PERSON IN CHARGE</label>
                            <select class="form-control" name="pic">
                            @foreach($userlist As $key=>$data)
                            @if($data->category === 'Employee')
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endif
                            @endforeach
                                
                            </select>  
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label>WASTE EXPIRED DATE</label>
                            <input type="date" name="expiredDate" class="form-control" id="expiredDate" required><br>

                        </div>
                        <div class="col">
                            <label>TRANSPORTER</label>
                            <select class="form-control" name="transporter">
                            @foreach($transporterlist As $key=>$data)
                                    <option value="{{ $data->fullname }}">{{ $data->fullname }}</option>
                            @endforeach
                                
                            </select>                       
                         </div>
                    </div>
                    <br>
                </div>
                
            </div>
            <input type="submit" name="SubmitWaste" class="btn btn-primary btn-bg-color btn-sm col-xs-2 margin-right" id="wasteform" style="float: right;" onclick="startCountdown()">
            

            
        </form>
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

   
$(document).ready(function(){
    $(".reset-btn").click(function(){
        $("#myForm").trigger("reset");
    });
});

</script>


@endsection
