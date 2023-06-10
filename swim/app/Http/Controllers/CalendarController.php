<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\ScheduledWaste;


class CalendarController extends Controller
{
    //
   

    public function empCalendar(Request $request)
    {
        $currentUser = Auth::user()->id;
        

        if ($request->ajax()) {

            

            $klTime = Carbon::now('Asia/Kuala_Lumpur'); // Get current KL time
            $start = $klTime->toDateString(); // Get the date part in YYYY-MM-DD format

            $data = scheduledwaste::select('id', 'wastecode as title', 'expiredDate as start')
                ->where ('scheduledwaste.id', '=', $currentUser)
                ->get();
                

            return response()->json($data);
        }
    

        return view('calendar.calendar', compact('currentUser'));

        
    }


      
}
