@extends('layouts.sideNav')

@section('content')
<h4>Scheduled Waste</h4>
<h6>Update Scheduled Waste Details</h6>
<style>
     input[type=text]{
        text-transform: capitalize;
    }
    input[type=text], textarea{
        text-transform: capitalize;
    }
</style>
<!-- message box if the new waste has been added -->
@if(session()->has('message'))
<div class="alert alert-success">   
    {{ session()->get('message') }}
</div>
@endif

<div class="card">
    <div class="card-body">
    @foreach($wastelist as $index => $data)
        <!-- form add waste -->
        <form method="POST" action="{{ route('updatedwaste',$data->swListID) }}" id="wasteform">
        @csrf
            @method('PUT')
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>Waste Code</label>
                            <input type="text" name="wastecode" class="form-control" value="{{$data->wastecode}}" required>
                        </div>
                        </div>
                        <div class="col">
                            <label>Weight(mt)</label>
                            <input type="number" name="weight" class="form-control" value="{{$data->weight}}" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>Waste Description</label>
                            <input type="text" name="wastedescription" class="form-control" value="{{$data->wastedescription}}" required>
                        </div>
                        </div>
                        <div class="col">
                            <label>Disposal Site</label>
                            <input type="text" name="disposalsite" class="form-control" value="{{$data->disposalsite}}" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>Waste Type</label>
                            <input type="text" name="wastetype" class="form-control" value="{{$data->wastetype}}" required>
                        </div>
                        </div>
                        <div class="col">
                            <label>Type Of Packaging</label>
                            <select class="form-control" name="packaging" required>
                                    <option value="">Please Select</option>
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
                            <label>Physical State</label>
                            <select class="form-control" name="state" required>
                                    <option value="" >Please Select</option>
                                    <option value="Solid">Solid</option>
                                    <option value="Gas">Gas</option>
                                    <option value="Liquid">Liquid</option>
                            </select>                       
                        </div>
                        </div>
                        <div class="col">
                            <label>Disposal Status</label>
                            <select class="form-control" name="statusDisposal"  required>
                                    <option value="">Please Select</option>
                                    <option value="Disposed">Disposed</option>
                                    <option value="Pending">Pending</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>Waste Generated Date</label>
                            <input type="date" name="wasteDate" class="form-control" id="txtDate" value="{{$data->wasteDate}}" required>
                        </div>
                        </div>
                        <div class="col">
                            <label>Person In Charge</label>
                            <select class="form-control" name="pic">
                            @foreach($userlist As $key=>$user)
                            @if($user->category === 'Employee')
                                    <option value="{{ $user->id }}">{{ $user ->name }}</option>
                            @endif
                            @endforeach

                            </select>  
                         </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>Waste Expired Date</label>
                            <input type="date" name="expiredDate" class="form-control" id="txtDate" value="{{$data->expiredDate}}" required>
                        </div>
                        </div>
                        <div class="col">
                            <label>Transporter</label>
                            <select class="form-control" name="transporter">
                            @foreach($transporterlist As $key=>$trans)
                                    <option value="{{ $trans->id }}">{{ $trans->fullname }}</option>
                                @endforeach
                            </select>                      
                         </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                        <div class="col">
                        <label>Receiver</label>
                            <select class="form-control" name="companyreceiver">
                            @foreach($receiverlist As $key=>$receive)
                                    <option value="{{ $receive->id }}">{{ $receive->companyname }}</option>
                                    @endforeach
                            </select>  
                        </div>
                        </div>
                        
                        <div class="col">
                            @if( auth()->user()->category== "Manager")
                            <label>Approval</label>
                                <select class="form-control" name="approval"  required>
                                        <option value="">Please Select</option>
                                        <option value="Reject">Reject</option>
                                        <option value="Approve">Approve</option>
                                </select>

                                @elseif( auth()->user()->category== "Employee")
                                <label>Approval</label>
                                <input type="text" name="approval" class="form-control" id="approval" value="{{$data->approval}}" readonly>

                                @endif
                        </div>              
                    </div>
                </div> 
            </div><br>
           <button class="btn btn-primary" style="float: right" type="button" data-bs-toggle="modal" data-bs-target="#confirmUpdate"  
           data-id="{{ $data->swListID }}" data-name="{{ $data->swListID }}">Update</button>

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
</div><br> 
@endforeach
<script type="text/javascript" src='https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js'></script>
<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script type="text/javascript" src='https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js'></script>

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

<!-- Add the SweetAlert2 library (v11.x) -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Initiate an Ajax request on button click
$(document).on("click", "button", function(){
    // Adding timestamp to set cache false
    $.get("/examples/php/customers.php?v="+ $.now(), function(data){
        $("body").html(data);
    });       
});

// Add remove loading class on body element depending on Ajax request status
$(document).on({
    ajaxStart: function(){
        $("body").addClass("loading"); 
    },
    ajaxStop: function(){ 
        $("body").removeClass("loading"); 
    }    
});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 



@endsection
