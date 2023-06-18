<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\MyTestMail;

use App\Models\scheduledwaste;

class WasteController extends Controller
{
    // RELATED TO SW
    public function NewWaste()
    {
        
        $userlist = DB::table('users')->get();
    
        // Get the transporters based on the status condition
        $transporterlist = DB::table('transporter')
            ->where('status', '!=', 'Non-Available')
            ->get();

        $receiverlist = DB::table('receiver')
        ->get();
    
        // Set the status based on the waste type selection
        $status = 'Non-Available'; // Default value
        $wasteType = request('wastetype');
        if ($wasteType !== 'Non-Available') {
            $status = 'Available';
        }
    
        return view('scheduledwaste.wasteEmp', compact('transporterlist', 'userlist', 'status', 'receiverlist'));
    }
    

    public function EditWaste(Request $request, $swListID, $transID, $receiveID)
    {
        $transporterlist = DB::table('transporter')
        ->where('status', '!=', 'Non-Available')
        ->get();

        $receiverlist = DB::table('receiver')  
        ->get();

        $userlist = DB::table('users')
        ->get();

        $wastelist = DB::table('scheduledwaste')
        ->join('users', 'users.id','=','scheduledwaste.pic')
        ->join('transporter', 'transporter.id','=','scheduledwaste.transporter')
        ->join('receiver', 'receiver.id','=','scheduledwaste.companyreceiver')
        ->select([
            'users.id AS userID',
            'transporter.id AS transID',
            'scheduledwaste.id AS swListID',
            'receiver.id AS receiveID',
            'users.*', 'scheduledwaste.*', 'transporter.*', 'receiver.*',
            'transporter.fullname AS transporterName'
        ])
        ->where('scheduledwaste.id', $swListID)
        ->where('transporter.id', $transID)
        ->where('receiver.id', $receiveID)
        ->get();
        

        return view('scheduledwaste.editwaste', compact('wastelist', 'userlist', 'transporterlist', 'receiverlist'));
    }


    public function UpdatedWaste(Request $request, $id)
    {
        $wastelist = scheduledwaste::find($id);


        // Update the waste item with the new values
        $wastelist->wastecode = $request->input('wastecode');
        $wastelist->weight = $request->input('weight');
        $wastelist->wastedescription = $request->input('wastedescription');
        $wastelist->disposalsite = $request->input('disposalsite');
        $wastelist->wastetype = $request->input('wastetype');
        $wastelist->packaging = $request->input('packaging');
        $wastelist->state = $request->input('state');
        $wastelist->statusDisposal = $request->input('statusDisposal');
        $wastelist->wasteDate = $request->input('wasteDate');
        $wastelist->pic = $request->input('pic');
        $wastelist->expiredDate = $request->input('expiredDate');
        $wastelist->transporter = $request->input('transporter');
        $wastelist->companyreceiver = $request->input('companyreceiver');
        $wastelist->approval = $request->input('approval');
        // upadate query in the database
        $wastelist->update();
 

        // display message box in the same page
        return redirect()->back()->with('message', 'Scheduled Waste Updated Successfully');
    }

    public function ListWaste()
    {

        $currentUser = Auth::user()->id;
        
        $wastelist = DB::table('scheduledwaste')
        ->join('users', 'users.id','=','scheduledwaste.pic')
        ->join('receiver', 'receiver.id','=','scheduledwaste.companyreceiver')
        ->where ('scheduledwaste.pic', '=', $currentUser)
        ->select([
            'users.id AS userID',
            'scheduledwaste.id AS swListID',
            'receiver.id AS receiveID', 
            'users.*', 'scheduledwaste.*', 'receiver.*'
        ])
        ->get();

        $wastelistManager = DB::table('scheduledwaste')
        ->join('users', 'users.id','=','scheduledwaste.pic')
        ->join('receiver', 'receiver.id','=','scheduledwaste.companyreceiver')
        ->select([
            'users.id AS userID',
            'scheduledwaste.id AS swListID',
            'receiver.id AS receiveID', 
            'users.*', 'scheduledwaste.*', 'receiver.*'
        ])
        ->get();

        $wasteData = [];

        foreach ($wastelist as $index => $waste) {
            // Set the timezone to Kuala Lumpur
            $kl_timezone = 'Asia/Kuala_Lumpur';

            // Get today's date in Kuala Lumpur timezone
            $today_date = Carbon::now($kl_timezone);
            $expiredWasteDate = Carbon::parse($waste->expiredDate);
            $diffInDays = $today_date->diffInDays($expiredWasteDate);

            $wasteData[$index] = [
                'diffInDays' => $diffInDays
            ];
        }

        foreach ($wastelistManager as $index => $waste) {
            // Set the timezone to Kuala Lumpur
            $kl_timezone = 'Asia/Kuala_Lumpur';

            // Get today's date in Kuala Lumpur timezone
            $today_date = Carbon::now($kl_timezone);
            $expiredWasteDate = Carbon::parse($waste->expiredDate);
            $diffInDays = $today_date->diffInDays($expiredWasteDate);

            $wasteData[$index] = [
                'diffInDays' => $diffInDays
            ];
        }
        return view('scheduledwaste.swlist', compact('wastelist', 'wasteData', 'currentUser','wastelistManager'));
        
    }

    public function pendingWaste()
    {
        $currentUser = Auth::user()->id;

        $wastelist = DB::table('scheduledwaste')
        ->join('users', 'users.id','=','scheduledwaste.pic')
        ->where ('scheduledwaste.pic', '=', $currentUser)
        ->select([
            'users.id AS userID',
            'scheduledwaste.id AS swListID', 'users.*', 'scheduledwaste.*'
        ])
        ->get();

        $wastelistManager = DB::table('scheduledwaste')
        ->join('users', 'users.id','=','scheduledwaste.pic')
        ->select([
            'users.id AS userID',
            'scheduledwaste.id AS swListID', 'users.*', 'scheduledwaste.*'
        ])
        ->get();


        $wasteData = [];

        foreach ($wastelist as $waste) {
            // Set the timezone to Kuala Lumpur
            $kl_timezone = 'Asia/Kuala_Lumpur';

            // Get today's date in Kuala Lumpur timezone
            $today_date = Carbon::now($kl_timezone);
            $expiredWasteDate = Carbon::parse($waste->expiredDate);
            $diffInDays = $today_date->diffInDays($expiredWasteDate);
        
            $wasteData[] = [
                'diffInDays' => $diffInDays
            ];
        }
        
       
        return view('scheduledwaste.pendingsw', compact('wastelist', 'wasteData', 'currentUser','wastelistManager'));
        
    }

    public function disposedWaste()
    {
        $wastelist = DB::table('scheduledwaste')
        ->join('users', 'users.id','=','scheduledwaste.pic')
        ->select([
            'users.id AS userID',
            'scheduledwaste.id AS swListID', 'users.*', 'scheduledwaste.*'
        ])
        ->get();

        $wasteData = [];

        foreach ($wastelist as $waste) {
            // Set the timezone to Kuala Lumpur
            $kl_timezone = 'Asia/Kuala_Lumpur';

            // Get today's date in Kuala Lumpur timezone
            $today_date = Carbon::now($kl_timezone);
            $expiredWasteDate = Carbon::parse($waste->expiredDate);
            $diffInDays = $today_date->diffInDays($expiredWasteDate);
        
            $wasteData[] = [
                'diffInDays' => $diffInDays
            ];
        }
        
       
        return view('scheduledwaste.disposedsw', compact('wastelist', 'wasteData'));
        
    }

    public function insertnewwaste(Request $request)
    {
        // get user auth
        $id = Auth::user()->id;
        $wastecode = $request->input('wastecode');
        $weight = $request->input('weight');
        $wastedescription = $request->input('wastedescription');
        $disposalsite = $request->input('disposalsite');
        $wastetype = $request->input('wastetype');
        $packaging = $request->input('packaging');
        $state = $request->input('state');
        $statusDisposal = $request->input('statusDisposal');
        $wasteDate = $request->input('wasteDate');
        $pic = $request->input('pic');
        $expiredDate = $request->input('expiredDate');
        $transporter = $request->input('transporter');
        $companyreceiver = $request->input('companyreceiver');
        $approval = $request->input('approval');

        $data = array(
            'wastecode' => $wastecode,
            'weight' => $weight,
            'wastedescription' => $wastedescription,
            'disposalsite' => $disposalsite,
            'wastetype' => $wastetype,
            'packaging' => $packaging,
            'disposalsite' => $disposalsite,
            'state' => $state,
            'statusDisposal' => $statusDisposal,
            'wasteDate' => $wasteDate,
            'pic' => $pic,
            'expiredDate' => $expiredDate,
            'transporter' => $transporter,
            'companyreceiver' => $companyreceiver,
            'approval' => $approval,

        );

        // insert query
        DB::table('scheduledwaste')->insert($data);
        
        return redirect()->route('swlist');
    }

    public function deletewaste(Request $request, $id)
    {
       

        if ($request->ajax()) {

            ScheduledWaste::where('id', '=', $id)->delete();
            return response()->json(array('success' => true));
        }
    }


    public function displaywaste(Request $request, $id)
    {         
        
        $transporterlist = DB::table('transporter')
        ->where('status', '!=', 'Non-Available')
        ->get();

        $wastelist = DB::table('scheduledwaste')
        ->join('users', 'users.id','=','scheduledwaste.pic')
        ->join('transporter', 'transporter.id','=','scheduledwaste.transporter')
        ->join('receiver', 'receiver.id','=','scheduledwaste.companyreceiver')
        ->select([
            'users.id AS userID',
            'transporter.id AS transID',
            'scheduledwaste.id AS swListID',
            'receiver.id AS receiveID',  
            'users.*', 'scheduledwaste.*', 'transporter.*', 'receiver.*',
            'transporter.fullname AS transporterName'
        ])
        ->where('scheduledwaste.id', $id)
        ->get();
        
        return view('scheduledwaste.displaywaste', ['wastelist' => $wastelist], compact('transporterlist'));
          
    }

        public function filter()
        {
            $wastelist = DB::table('scheduledwaste')
            ->join('users', 'users.id','=','scheduledwaste.pic')
            ->get();

        $wasteData = [];

        foreach ($wastelist as $waste) {
            // Set the timezone to Kuala Lumpur
            $kl_timezone = 'Asia/Kuala_Lumpur';

            // Get today's date in Kuala Lumpur timezone
            $today_date = Carbon::now($kl_timezone);
            $expiredWasteDate = Carbon::parse($waste->expiredDate);
            $diffInDays = $today_date->diffInDays($expiredWasteDate);
        
            $wasteData[] = [
                'diffInDays' => $diffInDays
            ];
        }
        
        return view('scheduledwaste.filteredsw', compact('wastelist', 'wasteData'));
        }

        public function getEmail(Request $request, $id)
        {

            $user = DB::table('scheduledwaste')
            ->join ('users', 'users.id','=','scheduledwaste.pic')

            ->select([
                'name', 'email'
            ])
            ->where('users.id', $id)
            ->first();

            $to = [

                [
                    'email' => $user->email,
                ]

            ];

            //send email
            $data = [
                
                'name' => $user->name,
            ];
           
            Mail::to($to)->send(new MyTestMail($data));
            
            return back()->with('success', 'Email Successfully Sent.');
           
        }  

      
        
        

      
  
}
