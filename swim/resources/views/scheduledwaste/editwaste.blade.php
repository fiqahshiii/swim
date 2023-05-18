@extends('layouts.sideNav')

@section('content')
<h4>Scheduled Waste</h4>
<h6>Update Scheduled Waste Details</h6>

<!-- message box if the new waste has been added -->
@if(session()->has('message'))
<div class="alert alert-success">   
    {{ session()->get('message') }}
</div>
@endif

<div class="card">
    <div class="card-body">
    @foreach($wastelist As $key=>$data)
        <!-- form add waste -->
        <form method="POST" action="{{ route('updatedwaste',$data->id) }}" id="wasteform">
        @csrf
            @method('PUT')
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>WASTE CODE</label>
                            <input type="text" name="wastecode" class="form-control" value="{{$data->wastecode}}" required>
                        </div>
                        </div>
                        <div class="col">
                            <label>WEIGHT (mt)</label>
                            <input type="number" name="weight" class="form-control" value="{{$data->weight}}" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>WASTE DESCRIPTION</label>
                            <input type="text" name="wastedescription" class="form-control" value="{{$data->wastedescription}}" required>
                        </div>
                        </div>
                        <div class="col">
                            <label>DISPOSAL SITE</label>
                            <input type="text" name="disposalsite" class="form-control" value="{{$data->disposalsite}}" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>WASTE TYPE</label>
                            <input type="text" name="wastetype" class="form-control" value="{{$data->wastetype}}" required>
                        </div>
                        </div>
                        <div class="col">
                            <label>TYPE OF PACKAGING</label>
                            <select class="form-control" name="packaging" value="{{$data->packaging}}" required>
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
                            <select class="form-control" name="state" value="{{$data->state}}" required>
                                    <option value="">PHYSICAL STATE</option>
                                    <option value="Solid">Solid</option>
                                    <option value="Gas">Gas</option>
                                    <option value="Liquid">Liquid</option>
                            </select>                       
                        </div>
                        </div>
                        <div class="col">
                            <label>DISPOSAL STATUS</label>
                            <select class="form-control" name="statusDisposal" value="{{$data->statusDisposal}}" required>
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
                            <input type="date" name="wasteDate" class="form-control" id="txtDate" value="{{$data->wasteDate}}" required>
                        </div>
                        <div class="col">
                            <label>PERSON IN CHARGE</label>
                            <input type="text" name="pic" class="form-control" placeholder="Person in Charge Name" value="{{$data->pic}}" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label>WASTE EXPIRED DATE</label>
                            <input type="date" name="expiredDate" class="form-control" id="txtDate" value="{{$data->expiredDate}}" required>
                        </div>
                 @endforeach
          
                        <div class="col">
                            <label>TRANSPORTER</label>
                            <input type="text" name="transporter" class="form-control" value="{{ $data->transporter}}" >                     
                         </div>
                    </div>
                    <br>
                </div> 
            </div>
            <button class="btn btn-danger" style="float: right" type="button" onclick="deleteItem(this)"  data-id="{{ $data->id }}" data-name="{{ $data->wastecode }}">Update</button>
               </div>

                  <!-- modal -->
            
            <!-- end of modal -->

        </form> 
</div><br> 
<script type="text/javascript" src='https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js'></script>
<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


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
