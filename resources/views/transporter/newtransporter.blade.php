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

<head>
    <style>
        .margin-right {
        margin-right: 10px !important;
    }
    textarea {
        resize: none;
        }
        .container1 {
        border-radius: 10px;
	    border-style: solid;
	    border-width: 2px;
        border-color: #666666;
        padding: 15px;
    }
    .form label {
        font-weight:bold;   
    }
    input[type=text]{
        text-transform: capitalize;
    }
   
    input[type=text], textarea{
        text-transform: capitalize;
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
    <h6><b>COMPANY DETAILS</h6></b>
    <form method="POST" action="{{ route('inserttransporter') }}" id="transporterform">
                    @csrf  
                    <div class="container1">                                                                                                                                                        
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <label>Company Name</label>
                                    <input type="text" name="companyname" class="form-control" placeholder="ABC Sdn Bhd" style="border-width: 1px; border-color: #666666;"  required>
                                </div>
                                <div class="col">
                                    <label>City</label>
                                    <input type="text" name="city" class="form-control" placeholder="City" style="border-width: 1px; border-color: #666666;" required>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                            <div class="col">
                                    <label>Address</label>
                                    <textarea rows="3" cols="50" type="text" name="address" class="form-control" placeholder="Address" style="border-width: 1px; border-color: #666666;" required></textarea>
                                </div>
                            <div class="col">
                                    <label>Remarks</label>
                                    <textarea rows="3" cols="50" type="text" name="remarks" class="form-control" placeholder="Remarks" style="border-width: 1px; border-color: #666666;" required></textarea>
                                </div>
                            </div>
                            <br>
                        </div> 
                    </div>
            </div><br>
            <!-- contact details -->
            <h6><b>CONTACT DETAILS</h6></b>
            <div class="container1">
                    <div class="row">
                        <div class="col">
                           <label>Full Name</label>
                            <input type="text" name="fullname" class="form-control" placeholder="Full Name" style="border-width: 1px; border-color: #666666;" required>
                        </div>
                        <div class="col">
                            <label>Phone Number</label>
                            <input type="number" name="phonenum" class="form-control" placeholder="Phone Number" style="border-width: 1px; border-color: #666666;" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label>Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="ABC@gmail.com" name="email" value="{{ old('email') }}" style="border-width: 1px; border-color: #666666;" required autocomplete="email">
                        </div>
                        <div class="col">
                            <label>Registered Plate Number</label>
                            <input type="text" name="platenumber" class="form-control" placeholder="Vehicle Plate" style="border-width: 1px; border-color: #666666;" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                    <div class="col">
                            <label>Status</label>
                            <select class="form-control" name="status" style="border-width: 1px; border-color: #666666;">
                                    <option value="">Status</option>
                                    <option value="Available">Available</option>
                                    <option value="Non-Available">Non-Available</option>
                            </select>                           
                        </div>
                        <div class="col">
                        </div>
                    </div>
                    <br>
               
            
            </div><br>
            <input type="submit" name="SubmitWaste" class="btn btn-primary" id="wasteform" style="float: right;">
        </form>
    </div>
   
</div><br>

<script type="text/javascript" src='https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js'></script>
<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

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
