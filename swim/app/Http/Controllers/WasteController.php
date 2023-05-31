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
        $transporterlist = DB::table('transporter')
       
            ->get();

            $userlist = DB::table('users')
       
            ->get();

        return view('scheduledwaste.wasteEmp', compact('transporterlist','userlist'));
    }

    public function EditWaste(Request $request, $id)
    {
        $wastelist = DB::table('scheduledwaste')
            ->where('id',$id)
            ->get();

            $transporterlist = DB::table('transporter')
            ->where('id',$id)
            ->get();

        return view('scheduledwaste.editwaste', compact('wastelist','transporterlist'));
    }

    public function UpdatedWaste(Request $request, $id)
    {
        // find the id from proposal
        $wastelist = scheduledwaste::find($id);
     
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

        // upadate query in the database
        $wastelist->update();

        // display message box in the same page
        return redirect()->back()->with('message', 'Product Updated Successfully');
    }


    public function ListWaste()
    {
        $wastelist = DB::table('scheduledwaste')
        ->join('users', 'users.id','=','scheduledwaste.pic')
        // ->orderBy('id', 'asc')
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
        
       
        return view('scheduledwaste.swlist', compact('wastelist', 'wasteData'));
        
    }

    public function pendingWaste()
    {
        $wastelist = DB::table('scheduledwaste')
        ->join('users', 'users.id','=','scheduledwaste.pic')
        // ->orderBy('id', 'asc')
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
        
       
        return view('scheduledwaste.pendingsw', compact('wastelist', 'wasteData'));
        
    }

    public function disposedWaste()
    {
        $wastelist = DB::table('scheduledwaste')
        ->join('users', 'users.id','=','scheduledwaste.pic')
        // ->orderBy('id', 'asc')
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

        );

        // insert query
        DB::table('scheduledwaste')->insert($data);

        return redirect()->route('swlist');
    }

    public function deletewaste(Request $request, $id)
    {
       

        if ($request->ajax()) {

            scheduledwaste::where('id', '=', $id)->delete();
            return response()->json(array('success' => true));
        }
    }

    public function displaywaste(Request $request, $id)
    {           
        $wastelist = DB::table('scheduledwaste')
            ->where('id', $id)
            ->get();

        $transporterlist = DB::table('transporter')
            ->where('id', $id)
            ->get();
        
        return view('scheduledwaste.displaywaste', compact('wastelist', 'transporterlist'));        
          
}

        public function filter()
        {
            $wastelist = DB::table('scheduledwaste')
        ->join('users', 'users.id','=','scheduledwaste.pic')
        // ->orderBy('id', 'asc')
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
