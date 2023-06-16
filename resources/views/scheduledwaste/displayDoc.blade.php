@extends('layouts.sideNav')
@section('content')
<h4>Add New File</h4>

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
<div class="card">
    <div class="card-body">
        <!-- form add waste -->
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>Scheduled Waste Code</label>
                            <input type="text" id="swcode" name="swcode" class="form-control" value="{{$document->swcode}}" readonly>
                        </div>
                        </div>          
                    </div><br>
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>File Name</label>
                            <input type="text" id="filename" name="filename" class="form-control" value="{{$document->filename}}" readonly>
                        </div>
                        </div>          
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>SOP FILE</label><br>
                            <input type="file" name="document" id="pdffile" accept="application/pdf" onchange="loadFile(this)"readonly>                        </div>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="col">
                <iframe src="/assets/{{$document->document}}" style="width: 455px; height: 405px; border-style: dashed"></iframe>
                
             
                </div>
            </div>
            <br>
            <a class="btn btn-primary" id="waste" style="float: right; color:white" href="{{ route('editDoc', $document->id) }}">Edit</a>
    </div>
</div><br>

@endsection
<script type="text/javascript" src='https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js'></script>
<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script type="text/javascript">
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


</script>