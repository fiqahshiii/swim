<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\User;

class AccountController extends Controller
{
    //
    public function AccountSetting($id)
    {
        $user = User::find($id);
        return view('account.viewAcc', ['user' => $user]);
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
}
