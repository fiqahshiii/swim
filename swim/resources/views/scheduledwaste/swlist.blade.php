@extends('layouts.sideNav')

@section('content')
<br><h4>Scheduled Waste List</h4>
<head>
<style>
    .overlay{
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 999;
        background: rgba(255,255,255,0.8) url("/examples/images/loader.gif") center no-repeat;
    }
    
    /* Turn off scrollbar when body element has the loading class */
    body.loading{
        overflow: hidden;   
    }
    /* Make spinner image visible when body element has the loading class */
    body.loading .overlay{
        display: block;
    }


        /* Add a CSS class to change the color to red */
        .red-text {
            color: red;
        }
        h4{
            font-family: Tahoma, Verdana, sans-serif;  
            font-size: 30px;
            /* color: white; */
        }
   
</style>
</head>
<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>
<script src="{{ asset('frontend') }}/js/dataTables.bootstrap4.js"></script>
<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>


<script>
$(document).ready(function() {
    $('#dataTable').DataTable({
        "order": [
            [0, "asc"]
        ],
        "language": {
            search: '<i class="fa fa-search" aria-hidden="true"></i>',
            searchPlaceholder: 'Search Waste'
        }
    });

    // filter REPAIR FORM
    $('.dataTables_filter input[type="search"]').css({
        'width': '300px',
        'display': 'inline-block',
        'font-size': '15px',
        'font-weight': '400'
    });
});
</script>


<div class="card">
    <div class="card-header pb-0">
        <div class="row">
            <div class=" {{  auth()->user()->category== 'Employee' ? 'col-lg-10 col-md-10 col-sm-10' : (request()->routeIs('swlist') ? 'col-lg-10 col-md-10 col-sm-10' : 'col-lg-12 col-md-12 col-sm-12') }}">
                <nav class="">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('swlist') ? 'active' : '' }}" href="{{ route('swlist') }}" role="tab" aria-selected="true">List Of scheduledwaste</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('pendingsw') ? '' : '' }}" href="{{ route('pendingsw') }}" role="tab" aria-selected="true">Pending Scheduled Waste</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('disposedsw') ? '' : '' }}" href="{{ route('disposedsw') }}" role="tab" aria-selected="true">Disposed Scheduled Waste</a>
                        </li>
                    </ul>
                </nav>
            </div>

            @if( auth()->user()->category== "Employee")

            @if(request()->routeIs('swlist'))
            <div class="col-lg-2 col-md-2 col-sm-2" style="float: right;">
            <!-- wasteEmp nama apa2 sama dengan route kat web.php -->
                <a class="btn btn-primary" style="float: right; background: #4775d1;" role="button" href="{{ route('wasteEmp') }}" >
                    <i class="fas fa-plus" ></i>&nbsp; Create New Waste</a>
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
                @if( auth()->user()->category== "Employee" || auth()->user()->category== "Manager" || auth()->user()->category== "Admin")
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Disposal Date</th>
                            <th>Scheduled Waste</th>
                            <th>Status</th>
                            <th>Day Remaining</th> 
                            <th>Person In Charge</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    @foreach($wastelist as $index => $data)
                    <tr id="row{{$data->id}}">
                        <td>{{ $data->swListID }}</td>
                        <td class="{{ $wasteData[$index]['diffInDays'] < 10 ? 'red-text' : '' }}">{{ $data->expiredDate }}</td>
                        <td>{{ $data->wastecode }}</td>
                        <td>{{ $data->statusDisposal }}</td>
                        <td>
                            @if(isset($wasteData[$index]))
                                {{ $wasteData[$index]['diffInDays'] }} day/days
                            @endif
                        </td>
                        <td>{{ $data->name }}</td>
                        <td>
                            <a type="button" class="btn btn-primary" href="{{ route('displaywaste', $data->swListID) }}" style="background: #4775d1;">View</a>
                            <button class="btn btn-danger" type="button" onclick="deleteItem(this)" data-id="{{ $data->swListID }}" data-name="{{ $data->wastecode }}">Delete</button>
                        </td>                        
                    </tr>
                @endforeach

                </tbody>
                
                </table>
                
                @endif
                
            </div>
        </div>
    </div>
    
</div><br>

<!-- script -> days remaining -->
<script>
   const endDateInput = document.getElementById('wasteDate');

// Get the value of the input field and convert it to a Date object
const endDate = new Date(endDateInput.value);

// Calculate the time remaining in days
const timeDiff = endDate.getTime() - Date.now();
const daysRemaining = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));

// Update the text on the page with the remaining time
document.getElementById('remaining-time').textContent = daysRemaining;

<Script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
// Initiate an Ajax request on button click
$(document).on("click", "button", function(){
    // Adding timestamp to set cache false
    $.get("/examples/php/customers.php?v="+ $.now(), function(data){
        $("body").html(data);
    });       
});

// Add remove loading class on body element depending on Ajax request status
$(document).on({
    ajaxStart: function(){
        $("body").addClass("loading"); 
    },
    ajaxStop: function(){ 
        $("body").removeClass("loading"); 
    }    
});
</script>
</script>

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
                    url: '{{url("/deleteWaste")}}/' + id,
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        if (data.success) {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'scheduled Waste has been deleted.',
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



<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>
<Script>

</script>

<script>
    $(document).ready(function() {
        // Retrieve event ID from URL parameter
        const urlParams = new URLSearchParams(window.location.search);
        const eventId = urlParams.get('eventId');

        // Check if event ID is available
        if (eventId) {
            // Scroll to the row with the corresponding event ID
            const targetRow = document.getElementById('row' + eventId);
            if (targetRow) {
                targetRow.scrollIntoView({ behavior: 'smooth' });
            }
        }
    });
</script>
<script>

</script>

<script>
    $(document).ready(function() {
        // Retrieve event ID from URL parameter
        const urlParams = new URLSearchParams(window.location.search);
        const eventId = urlParams.get('eventId');

        // Check if event ID is available
        if (eventId) {
            // Scroll to the row with the corresponding event ID
            const targetRow = document.getElementById('row' + eventId);
            if (targetRow) {
                targetRow.scrollIntoView({ behavior: 'smooth' });
            }
        }
    });
</script>


@endsection