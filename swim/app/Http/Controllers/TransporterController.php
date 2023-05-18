<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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
          $Address = $request->input('Address');
          $city = $request->input('city');
          $platenumber = $request->input('platenumber');
          $gender = $request->input('gender');
          $email = $request->input('email');
          $phonenum = $request->input('phonenum');
          $status = $request->input('status');
  
  
          $data = array(
             
              'fullname' => $fullname,
              'address' => $Address,
              'city' => $city,
              'platenumber' => $platenumber,
              'gender' => $gender,
              'email' => $email,
              'phonenum' => $phonenum,
              'status' => $status,
  
          );
  
          // insert query
          DB::table('transporter')->insert($data);

          return redirect()->route('translist');
          
    }
}
