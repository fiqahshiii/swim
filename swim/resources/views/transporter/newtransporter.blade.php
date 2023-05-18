@extends('layouts.sideNav')

@section('content')
<h4>Transporter</h4>
<h6>Add New Transporter</h6>

<!-- message box if the new proposal has been added -->
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<div class="card">
    <div class="card-body">
        <!-- form add transporter -->
        <form method="POST" action="{{ route('inserttransporter') }}" id="transporterform">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>FULL NAME</label>
                            <input type="text" name="fullname" class="form-control" placeholder="full Name" required>
                        </div>
                        </div>
                        <div class="col">
                            <label>ADDRESS</label>
                            <input type="text" name="Address" class="form-control" placeholder="Address" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>CITY</label>
                            <input type="text" name="city" class="form-control" placeholder="City" required>
                        </div>
                        </div>
                        <div class="col">
                            <label>VEHICLE PLATE NUMBER</label>
                            <input type="text" name="platenumber" class="form-control" placeholder="Vehicle Plate" required>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>GENDER</label>
                            <select class="form-control" name="gender">
                                    <option value="">GENDER</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                            </select> 
                        </div>
                        </div>
                        <div class="col">
                            <label>EMAIL</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>PHONE NUMBER</label>
                            <input type="text" name="phonenum" class="form-control" placeholder="Phone Number" required>
                        </div>
                        </div>
                        <div class="col">
                        <div class="col">
                            <label>STATUS</label>
                            <select class="form-control" name="status">
                                    <option value="">STATUS</option>
                                    <option value="Available">Available</option>
                                    <option value="Non-Available">Non-Available</option>
                            </select>                           
                        </div>
                        </div>
                    </div>
                    <br>
                </div>     
            </div>
            <input type="submit" name="SubmitWaste" class="btn btn-primary" id="wasteform" style="float: right;">
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
</script>
@endsection
