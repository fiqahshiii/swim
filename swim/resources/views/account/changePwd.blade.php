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
    .card{
        position: center;
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
        <form method="POST" action="{{ route('account.updatePassword') }}" enctype="multipart/form-data">
        @csrf          
        <div class="row mb-3">
            <label for="old_password" class="col-md-4 col-form-label text-md-end">Old Password</label>
            <div class="col-md-6">
                <input id="old_password" type="password" class="form-control" name="old_password" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="password" class="col-md-4 col-form-label text-md-end">New Password</label>
            <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="password_confirmation" class="col-md-4 col-form-label text-md-end">Confirm Password</label>
            <div class="col-md-6">
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
            </div>
        </div>

        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">Update Password</button>
            </div>
        </div>
       
    </form>
      

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

<script>
        $('.unmask').on('click', function(){  
    if($(this).prev('input').attr('type') == 'password')
        $(this).prev('input').prop('type', 'text');  
    else
        $(this).prev('input').prop('type', 'password');  
    return false;
    });
    //Begin supreme heuristics 
    $('.password').on('keyup',function (){
    var p_c = $('#p-c');
    var p = $('#p');
    console.log(p.val() + p_c.val());
    if(p.val().length > 0){
    if(p.val() != p_c.val()) {
        $('#valid').html("Passwords Don't Match");
    } else {
        $('#valid').html('');  
    }
        var s = 'weak'
    if(p.val().length > 5 && p.val().match(/\d+/g))
    s = 'medium';
    if(p.val().length > 6 && p.val().match(/[^\w\s]/gi))
    s = 'strong';   
    $('#strong span').addClass(s).html(s);
    }
    });

</script>
