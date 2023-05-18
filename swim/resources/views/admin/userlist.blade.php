@extends('layouts.sideNav')

@section('content')

<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>
<script src="{{ asset('frontend') }}/js/dataTables.bootstrap4.js"></script>
<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

<script>
    // to search the appointment 
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "order": [
                [0, "asc"]
            ],
            "language": {
                search: '<i class="fa fa-search" aria-hidden="true"></i>',
                searchPlaceholder: 'Search User by Name'
            }
        });

        // filter appointment
        $('.dataTables_filter input[type="search"]').css({
            'width': '300px',
            'display': 'inline-block',
            'font-size': '15px',
            'font-weight': '400'
        });
    });
</script>
<div class="page-header row no-gutters pb-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0 d-flex">
        <h1 class="page-title ml-3">List of Users</h1>
    </div>
</div>
<!-- to display the alert message if the record has been deleted -->
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<div class="card">
    <div class="card-header pb-0">
        <div class="row">
            <div class=" {{  auth()->user()->category== 'Admin' ? 'col-lg-10 col-md-10 col-sm-10' : (request()->routeIs('userlist') ? 'col-lg-10 col-md-10 col-sm-10' : 'col-lg-12 col-md-12 col-sm-12') }}">
                <nav class="">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('userlist') ? 'active' : '' }}" href="{{ route('userlist') }}" role="tab" aria-selected="true">List Of Users</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- if user == committee, then have add new appointment button  -->
            @if( auth()->user()->category== "Admin")

            @if(request()->routeIs('userlist'))
            <div class="col-lg-2 col-md-2 col-sm-2" style="float: right;">
            <!-- wasteEmp nama apa2 sama dengan route kat web.php -->
            </div>
            @else
            <div class="col-lg-2 col-md-2 col-sm-2" style="float: right;">
                <a class="btn btn-success" style="float: right; width:100%;" role="button" href="">
                    <i class="fa fa-cog"></i>&nbsp; -</a>
            </div>
            @endif

            @endif

        </div>
    </div>

    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                @if( auth()->user()->category== "Admin")
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Employee ID</th>
                            <th>Category</th>
                            <th>Profile Picture</th>                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($userlist As $key=>$data)
                        <tr id="row{{$data->id}}">
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->empid }}</td>
                            <td>{{ $data->category }}</td>
                            <td><img src="/assets/{{$data->image}}" width="100px" height="100px" style="float: middle; border-radius:50%">
</td>
                            <td><a type="button" class="btn btn-primary" href="{{ route('displayuser', $data->id)}}">View</a> 
                            <a type="button" class="btn btn-danger" href="{{ route('deleteUser', $data->id)}}">Delete</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @endif
                <!-- FOR EMPLOYEE TO VIEW RECORD APPOINTNMENT LIST END -->
            </div>
        </div>
    </div>


</div><br>

<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>
<Script>

</script>
@endsection