
@extends('layouts.sideNav')

@section('content')
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
                searchPlaceholder: 'Search appointment'
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
            <div class=" {{  auth()->user()->category== 'Manager' ? 'col-lg-10 col-md-10 col-sm-10' : (request()->routeIs('attendListEmp') ? 'col-lg-10 col-md-10 col-sm-10' : 'col-lg-12 col-md-12 col-sm-12') }}">
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
                            <th>Check-in</th>
                            <th>Check-out</th>
                            
                            
                        </tr>
                    </thead>

                    @php
                    $counter = 1;
                    @endphp
                    @foreach($attendListEmp as $index => $data)
                    
                    <tbody>
                        <tr id="row{{$data->id}}">
                            <td>{{ $counter }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->date }}</td>
                            <td>{{ $data->checkin }}</td>
                            <td>{{ $data->checkout }}</td>
                           
                        </tr>
                </tbody>
                        @php
                        $counter++;
                        @endphp
                @endforeach
                </table>

                @endif
                <!-- FOR Manager TO VIEW RECORD APPOINTNMENT LIST END -->
            </div>
        </div>
    </div>
</div>

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