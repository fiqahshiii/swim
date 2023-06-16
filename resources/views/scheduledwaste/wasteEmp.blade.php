    @extends('layouts.sideNav')

    @section('content')
    <h4>Scheduled Waste</h4>
    <h6>Add New Waste</h6>

    <!-- message box if the new waste has been added -->
    @if(session()->has('message'))
    <div class="alert alert-success">   
        {{ session()->get('message') }}
    </div>
    @endif
    <head>
        <style>
            .margin-right {
            margin-right: 10px !important;
        }

        input[type=text]{
            text-transform: capitalize;
        }
        input[type=text], textarea{
        text-transform: capitalize;
    }
        </style>

    <script>
    $(document).ready(function(){
        $(".reset-btn").click(function(){
            $("#myForm").trigger("reset");
        });
    });
    </script>
    </head>
    <div class="card">
        <div class="card-body">
            
            <!-- form add waste -->
            <form method="POST" action="{{ route('insertnewwaste') }}" id="wasteform">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                            <div class="col">
                                <label>Waste Code</label>
                                <input type="text" name="wastecode" class="form-control" placeholder="SW ***" required>
                            </div>
                            </div>
                            <div class="col">
                                <label>Weight(mt)</label>
                                <input type="number" name="weight" class="form-control" placeholder="Weight"  oninput="checkInput()" required>
                                <div id="error-message" style="color: red; display: none;">Weight must be less than or equal to 3</div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                            <div class="col">
                                <label>Waste Description</label>
                                <input type="text" name="wastedescription" class="form-control" placeholder="Waste Description" required>
                            </div>
                            </div>
                            <div class="col">
                                <label>Disposal Site</label>
                                <input type="text" name="disposalsite" class="form-control" placeholder="Disposal Site" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                            <div class="col">
                                <label>Waste Type</label>
                                <input type="text" name="wastetype" class="form-control" placeholder="Waste Type" required>
                            </div>
                            </div>
                            <div class="col">
                                <label>Type Of Packaging</label>
                                <select class="form-control" name="packaging">
                                        <option value="">Type Of Packaging</option>
                                        <option value="JumboBag">Jumbo Bag</option>
                                        <option value="IBC">IBC</option>
                                        <option value="Drum">Drum</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                            <div class="col">
                                <label>Physical State</label>
                                <select class="form-control" name="state">
                                        <option value="">Physical State</option>
                                        <option value="Solid">Solid</option>
                                        <option value="Gas">Gas</option>
                                        <option value="Liquid">Liquid</option>
                                </select>                       
                            </div>
                            </div>
                            <div class="col">
                                <label>Disposal Status</label>
                                <select class="form-control" name="statusDisposal" readonly>
                                        <option value="Pending">Pending</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                            <div class="col">
                                <label>Waste Generated Date</label>
                                <input type="date" name="wasteDate" class="form-control" id="wasteDate" required>
                            </div>
                            </div>
                            <div class="col">
                                <label>Person In Charge</label>
                                <select class="form-control" name="pic">
                                @foreach($userlist As $key=>$data)
                                @if($data->category === 'Employee')
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endif
                                @endforeach
                                    
                                </select>  
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                            <div class="col">
                                <label>Waste Expired Date</label>
                                <input type="date" name="expiredDate" class="form-control" id="expiredDate" required><br>

                            </div>
                            </div>
                        
                            <div class="col">
                                <label>Transporter</label>
                                @if ($status != 'Non-Available')
                                    <select class="form-control" name="transporter">
                                        @foreach ($transporterlist as $trans)
                                            <option value="{{ $trans->id }}">{{ $trans->fullname }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="text" class="form-control" value="Non-Available" readonly>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                            <div class="col">   
                            <label>Receiver</label>
                             
                                    <select class="form-control" name="companyreceiver">
                                        @foreach ($receiverlist as $receive)
                                            <option value="{{ $receive->id }}">{{ $receive->companyname }}</option>
                                        @endforeach
                                    </select>
                            </div>
                            </div>
                            <div class="col">
                                <label>Approval</label>
                                <select class="form-control" name="approval" readonly>
                                        <option value="inprogress">In-Progress</option>
                                </select>
                            </div>
                        </div>
                        <br>
                    </div>
                    
                </div>
                <input type="submit" name="SubmitWaste" class="btn btn-primary btn-bg-color btn-sm col-xs-2 margin-right" id="wasteform" style="float: right;" onclick="startCountdown()">   
            </form>
        </div>
    </div><br>
    <script type="text/javascript" src='https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js'></script>
    <script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script>
        function checkInput() {
        var inputField = document.getElementsByName('weight')[0];
        var inputValue = parseFloat(inputField.value);

        var errorMessage = document.getElementById('error-message');
        
        if (inputValue > 3) {
            errorMessage.style.display = 'block';
            inputField.setCustomValidity('Weight must be less than or equal to 3');
        } else {
            errorMessage.style.display = 'none';
            inputField.setCustomValidity('');
        }
        }
    </script>

    <!-- to avoid user choose the past date -->
    <script>
        $(function() {
            var dtToday = new Date();

            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if (month < 10)
                month = '0' + month.toString();
            if (day < 10)
                day = '0' + day.toString();

            var maxDate = year + '-' + month + '-' + day;
            $('#txtDate').attr('min', maxDate);
        });

    
    $(document).ready(function(){
        $(".reset-btn").click(function(){
            $("#myForm").trigger("reset");
        });
    });

    </script>
    <script>
    $(document).ready(function() {
        $("#statusDisposal").on("change", function() {
            var selectedStatus = $(this).val();
            if (selectedStatus === "Non-Available") {
                $("#transporterSelect").prop("disabled", true);
            } else {
                $("#transporterSelect").prop("disabled", false);
            }
        });
    });
    </script>


    @endsection
