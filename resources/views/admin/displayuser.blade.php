@extends('layouts.sideNav')
@section('content')
<h4>Update Profile</h4>

<head>
    <style>
        h4{
            font-family: "Copperplate", fantasy;
            font-size: 30px;
            /* color: white; */
        }
    </style>
</head>

<!-- Page Header -->
<!--
<div class="page-header row no-gutters pb-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0 d-flex">
        <h1 class="page-title ml-3">Student Overview</h1>
    </div>
</div>-->

<!-- to display message box proposal has been updated -->
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<!-- Page Header -->

        <!-- form add waste -->
            @csrf
            <div class="row">
            <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                <center><label>PROFILE PHOTO</label><br>
                                <!-- to preview the file from the input type in div -->
                                <img src="/assets/{{$displayuser->image}}" width="180px" style="float: middle; border-radius:50%"></center>
                                <input type="file" name="image" id="image" accept="image/*" onchange="loadImage(this)" value="{{$displayuser->image}}" style="color: black;">
                               

                                </div>  
                            </div> 
                        </div>           
                    </div><br>   
            </div>  
            
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <label>NAME</label>
                                    <input type="text" id="name" name="name" class="form-control" value="{{$displayuser->name}}" readonly>
                                </div>
                            </div><br>

                            <div class="row">
                                <div class="col">
                                    <label>PHONE</label>
                                    <input type="text" name="phone" class="form-control" value="{{$displayuser->phone}}" readonly>
                                </div>  
                            </div><br>

                            <div class="row">
                                <div class="col">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="{{$displayuser->email}}" readonly>
                                </div>  
                            </div><br>
                            <div class="row">
                                <div class="col">
                                    <label>Employee ID</label>
                                    <input type="empid" name="empid" class="form-control" value="{{$displayuser->empid}}" readonly>
                                </div>  
                            </div><br>
                            <div class="row">
                                <div class="col">
                                    <label>Category</label>
                                    <input type="category" name="category" class="form-control" value="{{$displayuser->category}}" readonly>
                                </div>  
                            </div><br>
                            <a href="{{ route('userlist',$displayuser->id) }}" style="color: white; background:#000066; border-radius: 3px;  
                            padding: 5px 10px; text-decoration: none; float: right;" class="previous">&laquo; Previous</a><br><br>  
                        </div>           
                    </div><br>   
                </div>      
            </div>
            
        </form>
           
    </div>
</div>

@endsection

<script>
    function loadImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#imgPreview')
                    .attr('src', e.target.result)
                    .width(250)
                    .height(250);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    
    
</script>