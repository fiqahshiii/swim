@extends('layouts.sideNav')

@section('content')
<b><br><h4>Report</h4></b>
<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>
<script src="{{ asset('frontend') }}/js/dataTables.bootstrap4.js"></script>
<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>



<!-- to display the alert message if the record has been deleted -->
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<div class="card">
        <div class="card-body">
            
            <!-- form add waste -->
            <form method="get" action="{{ route('generatereport') }}">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                            <label>Scheduled Waste Due Date</label>
                                <input type="date" name="expiredDate" class="form-control" id="expiredDate" required>
                            </div>
                            <div class="col">
                               
                            </div>
                            <div class="col">
                                <label></label>
                                <div class="col"><button class="btn btn-primary" style="float: right; background: #4775d1;">Generate Report</button></div>                            </div>

                        </div>
                        <br>
                        
                    </div> 
                </div>

                

                <div class="overflow-auto" style="overflow:auto;">
                    <div class="table-responsive">
                        @if( auth()->user()->category== "Manager" || auth()->user()->category== "Employee" || auth()->user()->category== "Admin")
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                        <div style="float: right; margin-bottom: 10px;">
                        @if($exportData)
                        <a href="{{ route('exportPDFAll', ['exportData' => $data]) }}" style="background: #4775d1" class="btn btn-primary">
                            <i class="material-icons">print</i> Export PDF</a>
                        @else
                        <a href="{{ route('exportPDFGenerated', ['exportData' => $data, 'expiredDate' => $expiredDate]) }}" style="background: #4775d1" class="btn btn-primary">
                        <i class="material-icons">print</i> Export PDF
                        </a>


                        @endif
              
                </div>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Scheduled Waste Code</th>
                                    <th>Expired Date</th>
                                    <th>Status</th>
                                    <th>Officer</th>
                                    
                                </tr>
                            </thead>

                            <tbody>
                            @php
                            $counter = 1;
                            @endphp
                            @foreach($reportlist As $key=>$data)
                            <tr id="row{{$data->id}}">
                                <td>{{ $counter }}</td>
                                <td>{{ $data->wastecode }}</td>
                                <td>{{ $data->expiredDate }}</td>
                                <td>{{ $data->status }}</td>
                                <td>{{ $data->fullname }}</td>
                            </tr>
                            @php
                            $counter++;
                            @endphp
                            @endforeach
                            </tbody>
                        </table>

                        @endif
                        <!-- FOR Manager TO VIEW RECORD APPOINTNMENT LIST END -->
                    </div>
        </div>
            </form>
        </div>
</div><br>

<script>
    function setMinDate() {
        const dateEndInput = document.querySelector('input[name="expiredDate"]');
        dateEndInput.min = dateStartInput.value;
    }
</script>
<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>
<script src="{{ asset('frontend') }}/js/dataTables.bootstrap4.js"></script>
<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>



@endsection