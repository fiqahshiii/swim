@extends('layouts.sideNav')
@section('content')
<h4>Update Profile</h4>
<h3>User Profile</h3>

<head>
    <style>
        h4{
            font-family: Tahoma, Verdana, sans-serif;           
            font-size: 25px;
            /* color: white; */
        }
        h3{
            font-family: Tahoma, Verdana, sans-serif;           
            font-size: 15px;
            /* color: white; */
        }
        input[type=text]{
        text-transform: capitalize;
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
        <form method="POST" action="{{ route('updateprofile', Auth::user()->id ) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
            <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                <center><label>PROFILE PHOTO</label><br>
                                <!-- to preview the file from the input type in div -->
                                <img src="/assets/{{$user->image}}" width="180px" height="240" style="float: middle; border-radius:50%"></center>
                                <input type="file" name="image" id="image" accept="image/*" onchange="loadImage(this)" value="{{$user->image}}" style="color: white;">
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
                                    <input type="text" id="name" name="name" class="form-control" value="{{$user->name}}" required>
                                </div>
                            </div><br>

                            <div class="row">
                                <div class="col">
                                    <label>PHONE</label>
                                    <input type="text" name="phone" class="form-control" value="{{$user->phone}}" required>
                                </div>  
                            </div><br>

                            <div class="row">
                                <div class="col">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="{{$user->email}}" required>
                                </div>  
                            </div><br>
                            <button type="button" class="btn btn-primary" style="background-color: #007bff; border-radius: 10px; border: none; width: 100px; color: white; font-size: 15px; float: right" data-bs-toggle="modal" data-bs-target="#confirmUpdate">
                            <b>UPDATE</b></button>  
                        </div>           
                    </div><br>   
                </div>      
            </div>
            
           

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