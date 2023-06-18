
@extends('layouts.sideNav')

@section('content')
<b><br><h4>Employee Record Attendance</h4></b>
<head>
    <style>

        th{
             text-align: center;
        }
        td{
             text-align: center;
        }
        input[type=text]{
            text-transform: capitalize;
        }
    </style>
</head>
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
                searchPlaceholder: 'Search by Name'
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

<!-- to display the alert message if the record has been deleted -->
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<div class="card">
    <div class="card-header pb-0">
        <div class="row">
            <div class=" {{  auth()->user()->category== 'Manager' ? 'col-lg-10 col-md-10 col-sm-10' : (request()->routeIs('EmpAttendance') ? 'col-lg-10 col-md-10 col-sm-10' : 'col-lg-12 col-md-12 col-sm-12') }}">
            </div>

          

        </div>
    </div>

    <div class="card-body">
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">

                @if( auth()->user()->category== "Manager" || auth()->user()->category== "Employee" || auth()->user()->category== "Admin")
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>

                    @php
                    $counter = 1;
                    @endphp
                    @foreach($userlist as $index => $data)
                    @if($data->category === 'Employee')
                    <tbody>
                        <tr id="row{{$data->id}}">
                            <td>{{ $counter }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td><a type="button" class="btn btn-primary" href="{{ route('attendDetails', $data->id) }}"
                            style="background: #4775d1;">Details</a>
                            </td>
                        </tr>
                </tbody>
                @php
                        $counter++;
                        @endphp
                @endif
                @endforeach
                

                @foreach($userlistAdmin as $index => $data)
                @php
                    $counter = 1;
                    @endphp
                    @if($data->category === 'Manager' )
                    <tbody>
                        <tr id="row{{$data->id}}">
                            <td>{{ $counter }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td><a type="button" class="btn btn-primary" href="{{ route('attendDetails', $data->id) }}"
                            style="background: #4775d1;">Details</a>
                            </td>
                        </tr>
                </tbody>
                @php
                $counter++;
                @endphp
                @endif
                @endforeach
               
                </table>

                @endif
                <!-- FOR Manager TO VIEW RECORD APPOINTNMENT LIST END -->
            </div>
        </div>
    </div>
</div><br>

<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>
<script>
function deleteItem(e) {
    let id = e.getAttribute('data-id');
    let name = e.getAttribute('data-name');

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success ml-1',
            cancelButton: 'btn btn-danger mr-1'
        },
        buttonsStyling: false
    });

    swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        html: "Name: " + name + "<br> You won't be able to revert this!",
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            if (result.isConfirmed) {

                $.ajax({
                    type: 'DELETE',
                    url: '{{url("/deleteFile")}}/' + id,
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        if (data.success) {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Document has been deleted.',
                                "success"
                            );

                            $("#row" + id).remove(); // you can add name div to remove
                        }


                    }
                });

            }

        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            // swalWithBootstrapButtons.fire(
            //     'Cancelled',
            //     'Your imaginary file is safe :)',
            //     'error'
            // );
        }
    });

}
</script>

@endsection