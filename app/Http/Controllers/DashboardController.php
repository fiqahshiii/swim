<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //authorize session from user type
    public function loadDashboard()

    {
        $category = Auth::user()->category;
    

        if ($category == 'Employee') {

            $countDisposedSW = DB :: table ('scheduledwaste')
            ->where ('statusDisposal', 'Disposed')
            ->count();

            $countPendingSW = DB :: table ('scheduledwaste')
            ->where ('statusDisposal', 'Pending')
            ->count();

            $countTotalSW = DB :: table ('scheduledwaste')->count();

            $c = DB :: table ('transporter')
            ->where ('status', 'Available')
            ->count();

            $countNonAvailTrans = DB :: table ('transporter')
            ->where ('status', 'Non-Available')
            ->count();

            $countAvailTrans = DB :: table ('transporter')
            ->where ('status', 'Available')
            ->count();


            $countTransporter = DB :: table ('transporter')->count();
            $countReceiver = DB :: table ('receiver')->count();

            $countApproveSW = DB :: table ('scheduledwaste')
            ->where ('approval', 'Approve')
            ->count();

            $countRejectSW = DB :: table ('scheduledwaste')
            ->where ('approval', 'Reject')
            ->count();

            $countinprogressSW = DB :: table ('scheduledwaste')
            ->where ('approval', 'inprogress')
            ->count();
            
            return view('dashboard.employee', compact('countDisposedSW','countPendingSW','countTotalSW','countTransporter', 
            'countAvailTrans','countNonAvailTrans', 'countReceiver',
            'countApproveSW','countRejectSW', 'countinprogressSW'));
        }

        if ($category == 'Manager') {

            $countDisposedSW = DB :: table ('scheduledwaste')
            ->where ('statusDisposal', 'Disposed')
            ->count();

            $countPendingSW = DB :: table ('scheduledwaste')
            ->where ('statusDisposal', 'Pending')
            ->count();

            $countTotalSW = DB :: table ('scheduledwaste')->count();

            


            return view('dashboard.manager', compact('countDisposedSW','countPendingSW','countTotalSW'));
        }

        if ($category == 'Admin') {
            //dd(Auth::user()->id);
          
            $countEmployee = DB :: table ('users')->count();
            $countTransporter = DB :: table ('transporter')->count();
            $countReceiver = DB :: table ('receiver')->count();


            $countTotalSW = DB :: table ('scheduledwaste')->count();
            return view('dashboard.admin', compact('countEmployee','countTransporter','countReceiver'));
        }
    }
}
