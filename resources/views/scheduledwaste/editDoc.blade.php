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
        input[type=text]{
            text-transform: capitalize;
        }
        input[type=text], textarea{
        text-transform: capitalize;
    }
    </style>
</head>

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
        <form method="POST" action="{{ route('UpdatedDoc',$document->id) }}" id="UpdatedDoc">
        @csrf
            @method('PUT')
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>Scheduled Waste Code</label>
                            <input type="text" id="swcode" name="swcode" class="form-control" value="{{$document->swcode}}" required>
                        </div>
                        </div>          
                    </div><br>
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>File Name</label>
                            <input type="text" id="filename" name="filename" class="form-control" value="{{$document->filename}}" required>
                        </div>
                        </div>          
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>SOP FILE</label><br>
                            <input type="file" name="document" id="pdffile" accept="application/pdf" onchange="loadFile(this)"required>                        </div>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="col">
                <iframe src="/assets/{{$document->document}}" style="width: 455px; height: 405px; border-style: dashed"></iframe>
                
             
                </div>
            </div>
            <br>
            <button class="btn btn-primary" style="float: right" type="button" data-bs-toggle="modal" data-bs-target="#confirmUpdate"  
           data-id="{{ $document->id }}" data-name="{{ $document->swcode }}">Update</button>    </div>
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

@endsection