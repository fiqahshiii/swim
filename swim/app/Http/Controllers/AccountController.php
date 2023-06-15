<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;


use App\Models\User;

class AccountController extends Controller
{
    //
    public function AccountSetting($id)
    {
        $user = User::find($id);
        return view('account.viewAcc', ['user' => $user]);
    }

    public function ResetPassword($id)
    {
        $user = User::find($id);
        return view('account.changePwd', ['user' => $user]);
    }
    
    public function updateprofile(Request $request, $id)
    {
            $user = User::find($id);
            // unlink the old proposal file from assets folder
            
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->image = $request->file('image');

            // to rename the proposal file
            $filename = time() . '.' . $user->image->getClientOriginalExtension();

            // to store the file by moving to assets folder
            $request->image->move('assets', $filename);
            //untuk rename
            $user->image = $filename;

            $user->update();
 
            return redirect()->back();
    }

    public function updatePwd(Request $request, $id)
    {
            $user = User::find($id);
            // unlink the old proposal file from assets folder
            
            $user->password = $request->input('password');
            

            $user->update();
 
            return redirect()->back();
    }

    public function UserList()
    {
        $userlist = DB::table('users')
        ->orderBy('id', 'asc')
        ->get();
        
       
        return view('admin.userlist', compact('userlist'));
    }

    public function displayUser(Request $request, $id)
    {
   
        $displayuser = DB::table('users')
        ->where('id',$id)
        ->first();

        return view('admin.displayuser', compact('displayuser'));
        
    }

    public function deleteuser(Request $request, $id)
    {
        // find proposal id
        $deleteUser = User::find($id);

        // delete the record from the database
        DB::delete('DELETE FROM users WHERE id = ?', [$id]);

        echo "Record deleted successfully.<br/>";
        return redirect()->back()->with('message', 'User Deleted Successfully');
    }

    public function attendance()
    {
        $currentUser = Auth::user()->id;

        $attendList = DB::table('attendance')
        ->where ('attendance.userID', '=', $currentUser)
        ->get();
    
        return view('account.attendance', compact('attendList','currentUser'));
    }
    
    public function checkIn()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Check if the user has already checked in today
        $existingAttendance = DB::table('attendance')
            ->where('userID', $user->id)
            ->whereDate('date', Carbon::now()->toDateString())
            ->first();

        if ($existingAttendance) {
            return redirect()->back()->with('message', 'You have already checked in today.');
        }

        // Get the authenticated user
        $userID = Auth::user()->id;    
        // Set the timezone to Kuala Lumpur
        $kl_timezone = 'Asia/Kuala_Lumpur';

        // Get today's date in Kuala Lumpur timezone
        $today_date = Carbon::now($kl_timezone)->toDateString();
        $checkinTime = Carbon::now($kl_timezone)->toTimeString();

       $data = array(
            'userID' => $userID,
            'date' => $today_date,
            'checkin' => $checkinTime,

        );

        // insert query
        DB::table('attendance')->insert($data);
    
        return redirect()->back()->with('message', 'Check-in successful');
    }

    public function checkOut($id)
    {

    // Set the timezone to Kuala Lumpur
    $kl_timezone = 'Asia/Kuala_Lumpur';

    // Get today's date in Kuala Lumpur timezone
    $today_date = Carbon::now($kl_timezone)->toDateString();
    $checkoutTime = Carbon::now($kl_timezone)->toTimeString();

    // Update the attendance record for the user with the checkout time
        DB::table('attendance')
        
            ->where('id', $id)
            ->update(['checkout' => $checkoutTime]);

        return redirect()->back()->with('message', 'Check-out successful');
    }

    public function EmpAttendance()
    {
        
        $attendList = DB::table('attendance')
        ->get();
    
        return view('account.EmpAttendance', compact('attendList'));
    }

    public function ListAttendance()
    {
        
       

        $userlist = DB::table('users')
        ->orderBy('id', 'asc')
        ->get();
        
       
        return view('account.EmpAttendance', compact('userlist'));
    
    }

    public function attendDetailsEmp(Request $request, $id)
    {
        $attendanceEmp = User :: find($id);
        
        $attendListEmp = DB::table('attendance')
        ->join('users', 'users.id','=','attendance.userID')
        
        
        ->select([
            'users.id AS userID',
            'attendance.id AS attendID', 
            'users.*', 'attendance.*'
        ])
        
        ->where('userID', $id)
        ->get();
    
        return view('account.attendDetails', compact('attendListEmp','attendanceEmp'));
    }

    public function updatePassword(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'old_password' => 'required',
        'password' => 'required|min:8|confirmed',
    ]);

    // Check if the old password matches the user's current password
    if (!Hash::check($request->old_password, $user->password)) {
        return redirect()->back()->with('error', 'Old password is incorrect.');
    }

    // Update the user's password
    $user->password = Hash::make($request->password);
    $user->save();

    return redirect()->back()->with('message', 'Password updated successfully.');
}

    
    

}
