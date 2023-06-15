@extends('layouts.sideNav')

@section('content')
<h4>Receiver</h4>
<h6>Add New Receiver</h6>

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
    <form method="POST" action="{{ route('UpdatedReceiver', $receiverlist->id) }}" id="receiverlist">
        @csrf
            @method('PUT')
            <h6><b>COMPANY DETAILS</h6></b>
                    <div class="container1">                                                                                                                                                        
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <label>Company Name</label>
                                    <textarea rows="3" cols="50" type="text" name="companyname" class="form-control" placeholder="Company Name" 
                                    style="border-width: 1px; border-color: #666666;" required>{{$receiverlist->companyname}}</textarea>
                                </div>
                                <div class="col">
                                <label>Remarks</label>
                                    <textarea rows="3" cols="50" type="text" name="remarks" class="form-control" placeholder="Remarks" 
                                    style="border-width: 1px; border-color: #666666;"  required>{{$receiverlist->remarks}}</textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                            <div class="col">
                                    <label>Address</label>
                                    <textarea rows="3" cols="50" type="text" name="address" class="form-control" placeholder="Address" 
                                    style="border-width: 1px; border-color: #666666;" required>{{$receiverlist->address}}</textarea>
                                </div>
                                <div class="col">
                               
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                
                                </div>
                                <div class="col">
                               
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
                            <input type="text" name="fullname" class="form-control" placeholder="Full Name" s
                            tyle="border-width: 1px; border-color: #666666;" value="{{$receiverlist->fullname}}" required>
                        </div>
                        <div class="col">
                            <label>Phone Number</label>
                            <input type="text" name="phonenum" class="form-control" placeholder="Phone Number" 
                            style="border-width: 1px; border-color: #666666;" value="{{$receiverlist->phonenum}}" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label>Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="ABC@gmail.com" name="email"  
                            style="border-width: 1px; border-color: #666666;" value="{{$receiverlist->email}}" required autocomplete="email" required>

                        </div>
                        <div class="col">
                        <label>Fax Number</label>
                            <input type="text" name="fax" class="form-control" placeholder="Fax Number" 
                            style="border-width: 1px; border-color: #666666;" value="{{$receiverlist->fax}}" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                    <div class="col">
                                                   
                        </div>
                        <div class="col">
                        </div>
                    </div>
                    <br>
               
            
            </div><br>
            <button class="btn btn-primary" style="float: right" type="button" data-bs-toggle="modal" data-bs-target="#confirmUpdate"  data-id="{{ $receiverlist->id }}" data-name="{{ $receiverlist->fullname }}">Update</button>
             <!-- modal -->
             <div class="modal fade" id="confirmUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">Update Confirmation</h1>
                        </div>
                        <div class="modal-body">
                            Do you want to proceed with your update
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                        </div>
                    </div>
                    </div>

                    <div id="myModal" class="modal">
                    <span class="close">&times;</span>
                    <img class="modal-content" id="img01">
                    <div id="caption"></div>
                    </div>
            <!-- end of modal -->
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
