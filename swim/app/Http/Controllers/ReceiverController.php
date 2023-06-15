<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Receiver;

class ReceiverController extends Controller
{
    public function ListReceiver()
    {
        $receiverlist = DB::table('receiver')
            ->orderBy('fullname', 'asc')
            ->get();

        return view('transporter.receiverList', compact('receiverlist'));
    }
    
    public function NewReceiver()
    {
        
        return view('transporter.newreceiver');
    }


    public function insertreceiver(Request $request)
    {
          // get user auth
          $id = Auth::user()->id;
          $fullname = $request->input('fullname');
          $phonenum = $request->input('phonenum');
          $companyname = $request->input('companyname');
          $address = $request->input('address');
          $remarks = $request->input('remarks');
          $email = $request->input('email');
          $fax = $request->input('fax');
  
  
          $data = array(
             
              'fullname' => $fullname,
              'phonenum' => $phonenum,
              'companyname' => $companyname,
              'address' => $address,
              'remarks' => $remarks,
              'email' => $email,
              'fax' => $fax,              
  
          );
  
          // insert query
          DB::table('receiver')->insert($data);

          return redirect()->route('receiverlist');
          
    }

    public function displayReceiver(Request $request, $id)
    {      
        $receiverlist = Receiver::find($id);

        return view('transporter.displayreceiver', compact ('receiverlist'));        
          
    }

    public function EditReceiver(Request $request, $id)
    {
        $receiverlist = DB::table('receiver')
            ->where('id', $id)
            ->first();

        return view('transporter.editReceiver', compact('receiverlist'));
    }

    public function UpdatedReceiver(Request $request, $id)
    {

        // find the id from proposal
        $receiverlist = Receiver::find($id);
     
        $receiverlist->fullname = $request->input('fullname');
        $receiverlist->phonenum = $request->input('phonenum');
        $receiverlist->companyname = $request->input('companyname');
        $receiverlist->address = $request->input('address');
        $receiverlist->remarks = $request->input('remarks');
        $receiverlist->email = $request->input('email');
        $receiverlist->fax = $request->input('fax');
        
       
        // upadate query in the database
        $receiverlist->update();

        // display message box in the same page
        return redirect()->back()->with('message', 'Product Updated Successfully');
        
    }

    public function deleteReceiver(Request $request, $id)
    {
       

        if ($request->ajax()) {

            transporter::where('id', '=', $id)->delete();
            return response()->json(array('success' => true));
        }
    }

}
