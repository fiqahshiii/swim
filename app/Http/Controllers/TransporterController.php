<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Transporter;
use App\Mail\TransEmail;

class TransporterController extends Controller

{
    //
    public function ListTransporter()
    {
        $transporterlist = DB::table('transporter')
            ->orderBy('fullname', 'asc')
            ->get();

        return view('transporter.transporterList', compact('transporterlist'));
    }
    public function NewTransporter()
    {
        
        return view('transporter.newtransporter');
    }
    public function inserttransporter(Request $request)
    {
          // get user auth
          $id = Auth::user()->id;
          $fullname = $request->input('fullname');
          $phonenum = $request->input('phonenum');
          $email = $request->input('email');
          $companyname = $request->input('companyname');
          $remarks = $request->input('remarks');
          $platenumber = $request->input('platenumber');
          $city = $request->input('city');
          $address = $request->input('address');
          $status = $request->input('status');
  
  
          $data = array(
             
              'fullname' => $fullname,
              'phonenum' => $phonenum,
              'email' => $email,
              'companyname' => $companyname,
              'remarks' => $remarks,
              'platenumber' => $platenumber,
              'city' => $city,              
              'address' => $address,
              'city' => $city,
              'status' => $status,
  
          );
  
          // insert query
          DB::table('transporter')->insert($data);

          return redirect()->route('translist');
          
    }

    public function displaytrans(Request $request, $id)
    {      
        $translist = Transporter::find($id);

        return view('transporter.displaytrans', compact ('translist'));        
          
    }

    public function EditTransporter(Request $request, $id)
    {
        $translist = DB::table('transporter')
            ->where('id', $id)
            ->first();

        return view('transporter.editTransList', compact('translist'));
    }


    public function UpdatedTrans(Request $request, $id)
    {

        // find the id from proposal
        $translist = Transporter::find($id);
     
        $translist->fullname = $request->input('fullname');
        $translist->phonenum = $request->input('phonenum');
        $translist->email = $request->input('email');
        $translist->companyname = $request->input('companyname');
        $translist->remarks = $request->input('remarks');
        $translist->platenumber = $request->input('platenumber');
        $translist->city = $request->input('city');
        $translist->address = $request->input('address');
        $translist->status = $request->input('status');
       
        // upadate query in the database
        $translist->update();

        // display message box in the same page
        return redirect()->back()->with('message', 'Transporter Updated Successfully');
        
    }

    public function deleteTransporter(Request $request, $id)
    {
       

        if ($request->ajax()) {

            transporter::where('id', '=', $id)->delete();
            return response()->json(array('success' => true));
        }
    }

    public function getEmailTrans(Request $request, $id)
        {

            $user = DB::table('transporter')
            

            ->select([
                'fullname', 'email'
            ])
            
            ->first();

            $to = [

                [
                    'email' => $user->email,
                ]

            ];

            //send email
            $data = [
                
                'fullname' => $user->fullname,
            ];
           
            Mail::to($to)->send(new TransEmail($data));
            
            return back()->with('success', 'Email Successfully Sent.');
           
        }  
}
