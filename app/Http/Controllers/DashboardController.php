<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\document;
use App\Models\scheduledwaste;

class DashboardController extends Controller
{
    //authorize session from user type
    public function loadDashboard()

    {
        $category = Auth::user()->category;
    

        if ($category == 'Employee') {

            $currentUser = auth()->user();

            $countDisposedSW = DB :: table ('scheduledwaste')
            ->where ('statusDisposal', 'Disposed')
            ->where ('pic', $currentUser->id)
            ->count();

            $countPendingSW = DB :: table ('scheduledwaste')
            ->where ('statusDisposal', 'Pending')
            ->where ('pic', $currentUser->id)
            ->count();

            $countTotalSW = DB :: table ('scheduledwaste')
            ->where ('pic', $currentUser->id)
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
            ->where ('pic', $currentUser->id)
            ->count();

            $countRejectSW = DB :: table ('scheduledwaste')
            ->where ('approval', 'Reject')
            ->where ('pic', $currentUser->id)
            ->count();

            $countinprogressSW = DB :: table ('scheduledwaste')
            ->where ('approval', 'inprogress')
            ->count();
            
            return view('dashboard.employee', compact('countDisposedSW','countPendingSW','countTotalSW','countTransporter', 
            'countAvailTrans','countNonAvailTrans', 'countReceiver',
            'countApproveSW','countRejectSW', 'countinprogressSW','currentUser'));
        }

        if ($category == 'Manager') {

        $wastelist = DB::table('document')
        ->select('swcode', DB::raw('COUNT(*) as file_count'))
        ->groupBy('swcode')
        ->get();

        $countDisposedSW = DB::table('scheduledwaste')
            ->where('statusDisposal', 'Disposed')
            ->count();

        $countPendingSW = DB::table('scheduledwaste')
            ->where('statusDisposal', 'Pending')
            ->count();

        $countTotalSW = DB::table('scheduledwaste')->count();

        $countNonAvailTrans = DB::table('transporter')
            ->where('status', 'Non-Available')
            ->count();

        $countAvailTrans = DB::table('transporter')
            ->where('status', 'Available')
            ->count();

        $countTransporter = DB::table('transporter')->count();
        $countReceiver = DB::table('receiver')->count();

        return view('dashboard.manager', compact(
            'countDisposedSW',
            'countPendingSW',
            'countTotalSW',
            'countNonAvailTrans',
            'countAvailTrans',
            'countTransporter',
            'countReceiver',
            'wastelist'
        ));
            }

        if ($category == 'Admin') {
            //dd(Auth::user()->id);
          
            $countEmployee = DB :: table ('users')->count();
            $countTransporter = DB :: table ('transporter')->count();
            $countReceiver = DB :: table ('receiver')->count();
            $countTotalSW = DB :: table ('scheduledwaste')->count();

            $wastelist = DB::table('document')
            ->select('swcode', DB::raw('COUNT(*) as file_count'))
            ->groupBy('swcode')
            ->get();

            $countDisposedSW = DB::table('scheduledwaste')
            ->where('statusDisposal', 'Disposed')
            ->count();

            $countPendingSW = DB::table('scheduledwaste')
            ->where('statusDisposal', 'Pending')
            ->count();

            $countApproveSW = DB :: table ('scheduledwaste')
            ->where ('approval', 'Approve')
            ->count();

            $countRejectSW = DB :: table ('scheduledwaste')
            ->where ('approval', 'Reject')
            ->count();

            $countinprogressSW = DB :: table ('scheduledwaste')
            ->where ('approval', 'inprogress')
            ->count();

            return view('dashboard.admin', compact('countEmployee','countTransporter',
            'countReceiver', 'wastelist', 'countDisposedSW', 'countPendingSW',
            'countApproveSW', 'countRejectSW', 'countinprogressSW'));
        }
    }
}
