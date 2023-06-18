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
            <form method="get" action="{{ route('generatereport') }}">
                <div class="row">
                    <div class="col mb-3">
                        <label>Scheduled Waste Due Date</label>
                        <input type="date" name="expiredDate" class="form-control" id="expiredDate">
                    </div>

                    <div class="col">
                        
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col"><button class="btn btn-primary" style="float: right; background: #4775d1;">Generate Report</button></div>
                </div>
            </form>
        </div>
    </div>
    <br>   
    
    <div class="card">
        <div class="card-header pb-0">
            <div style="float: right; margin-bottom: 10px;">
                @if($exportData)
              
                    <button type="button" id="printBtn" class="btn btn-dark" style="float: right;  background: #4775d1; border:none; border-radius:3px;" 
                    onclick="printCard()"><i class="material-icons">print</i>Print PDF</button>
               

                <a href="{{ route('exportExcelAll', ['exportData' => $data]) }}" class="btn btn-primary" style="background: #4775d1; border-color: #007bff;"  ><i class="material-icons">print</i> Export Excel</a>
                @else

            
                    <button type="button" id="printBtn" class="btn btn-dark" style="float: right;  background: #4775d1; border:none; border-radius:3px;" 
                    onclick="printCard()"><i class="material-icons">print</i>Print PDF</button>
               
                <a href="{{ route('exportExcelGenerated', ['exportData' => $data, 'expiredDate' => $expiredDate]) }}" class="btn btn-primary" style="background: #4775d1; border-color: #007bff;" ><i class="material-icons">print</i> Export Excel</a>
                @endif
            </div>
        </div>

        <div class="card-body">
            <div class="overflow-auto" style="overflow:hidden;">
                <div class="table-responsive">
                @if( auth()->user()->category== "Manager" || auth()->user()->category== "Employee" || auth()->user()->category== "Admin")
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                    <th>ID</th>
                                    <th>SWCode</th>
                                    <th>Expired Date</th>
                                    <th>Officer In Charge</th>
                                    <th>Transporter</th>
                                    <th>Receiver</th>
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
                                <td>{{ $data->fullname }}</td>
                                <td>{{ $data->phonenum }}</td>
                                <td>{{ $data->companyname }}</td>
                            </tr>
                            @php
                            $counter++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
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

<script>
    function printCard() {
        // Open a new window
        var printWindow = window.open('', '_blank');

        // Get the HTML content of the table
        var tableContent = document.querySelector('#dataTable').outerHTML;

        // Create a new HTML document
        var printDocument = '<!DOCTYPE html><html><head>';
        printDocument += '<style>table { border-collapse: collapse; width: 100%; } th, td { border: 1px solid #000; padding: 8px; }</style>';
        printDocument += '</head><body>';
        printDocument += '<h1>Scheduled Waste List</h1>'; // Add your desired title here
        printDocument += '<table>' + tableContent + '</table>';
        printDocument += '</body></html>';

        // Write the HTML content to the new window
        printWindow.document.open();
        printWindow.document.write(printDocument);
        printWindow.document.close();

        // Print the new window
        printWindow.print();
    }
</script>

@endsection