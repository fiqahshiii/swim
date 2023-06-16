
@extends('layouts.sideNav')

@section('content')
<b><br><h4>Attendance</h4></b>
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
            <div class=" {{  auth()->user()->category== 'Employee' ? 'col-lg-10 col-md-10 col-sm-10' : (request()->routeIs('attendance') ? 'col-lg-10 col-md-10 col-sm-10' : 'col-lg-12 col-md-12 col-sm-12') }}">
            </div>

            @if( auth()->user()->category== "Employee")

            @if(request()->routeIs('attendance'))
            @else
            <div class="col-lg-2 col-md-2 col-sm-2" style="float: left;">
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

            <div class="col-lg-2 col-md-2 col-sm-2" style="float: left;">
                @if ($attendList->contains('date', now()->toDateString()))
                    <button class="btn btn-primary" style="float: right; width:100%; background:#2952a3;" disabled>Check-in</button>
                @else
                    <form id="checkInForm" method="post" action="{{ route('checkIn') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary" style="float: right; width:100%; background:#2952a3;" role="button">Check-in</button>
                    </form>
                @endif
            </div>


                @if( auth()->user()->category== "Manager" || auth()->user()->category== "Employee" || auth()->user()->category== "Admin")
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Check-in</th>
                            <th>Check-out</th>
                        </tr>
                    </thead>

                    @foreach($attendList as $index => $data)
                    <tbody>
                        <tr id="row{{$data->id}}">
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->date }}</td>
                            <td>{{ $data->checkin }}</td>
                            <td>
                                @if ( $data->checkout == null )
                                <center><a href="{{ route('checkOut', $data->id) }}" class="btn btn-primary" 
                                style="width:40%; background:#2952a3;" role="button">Check-out</a></center>
                                @else 
                                {{ $data->checkout }}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                </tbody>
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