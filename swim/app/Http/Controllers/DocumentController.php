<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    //
   
    public function ListofFile()
    {
        $document = DB::table('document')
        ->orderBy('id', 'asc')
        ->get();
        return view('scheduledwaste.sopFileList', compact('document'));
    }

    public function NewFile()
    {
        return view('scheduledwaste.newSOPfile');
    }

    public function insertdocument(Request $request)
    {
          // get user auth
          
          $swcode = $request->input('swcode');
          $filename = $request->input('filename');
          $document = $request->file('document');

           // to rename the proposal file
           $docname = time() . '.' . $document->getClientOriginalExtension();

           // to store the file by moving to assets folder
           $request->document->move('assets', $docname);
         
          $data = array(
             
              'swcode' => $swcode,
              'filename' => $filename,
              'document' => $docname,
          );
  
          // insert query
          DB::table('document')->insert($data);

          return redirect()->route('swfile');
          
    }

    public function displayDoc(Request $request, $id)
    {
   
        $document = DB::table('document')
        ->where('id',$id)
        ->first();

        return view('scheduledwaste.displayDoc', compact('document'));
        
    }

    public function deletefile(Request $request, $id)
    {
       

        if ($request->ajax()) {

            document::where('id', '=', $id)->delete();
            return response()->json(array('success' => true));
        }
    }
}
