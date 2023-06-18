<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\scheduledwaste;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Response;

class ReportController extends Controller
{

    public function report()
    {
        // Set the timezone to Kuala Lumpur
        $kl_timezone = 'Asia/Kuala_Lumpur';

        // Get today's date in Kuala Lumpur timezone
        $today_date = Carbon::now($kl_timezone)->toDateString();

        $data = 'AllReport';

        $reportlist = DB::table('scheduledwaste')
        ->join('users', 'users.id','=','scheduledwaste.pic')
        ->join('transporter', 'transporter.id','=','scheduledwaste.transporter')
        ->join('receiver', 'receiver.id','=','scheduledwaste.companyreceiver')
        ->orderBy('scheduledwaste.id', 'desc')
        ->get();
    
        return view('Report.Report', compact('reportlist'))->with('data', $data)->with('exportData', true);
    }

    public function generatereport(Request $request)
    {
        //request input from form 
        $expiredDate = $request->input('expiredDate');

        // Set the timezone to Kuala Lumpur
        $kl_timezone = 'Asia/Kuala_Lumpur';

        // Get today's date in Kuala Lumpur timezone
        $today_date = Carbon::now($kl_timezone)->toDateString();

        $data = 'GeneratedReport';

            $reportlist = DB::table('scheduledwaste')
            ->orderBy('scheduledwaste.id', 'desc')
            ->join('users', 'users.id','=','scheduledwaste.pic')
            ->join('transporter', 'transporter.id','=','scheduledwaste.transporter')
            ->join('receiver', 'receiver.id','=','scheduledwaste.companyreceiver')
            ->select([
                'users.id AS userID',
                'transporter.id AS transID',
                'scheduledwaste.id AS swListID',
                'receiver.id AS receiveID',
                'users.*', 'scheduledwaste.*', 'transporter.*', 'receiver.*',
                'transporter.fullname AS transporterName'
            ])
            ->where('expiredDate', [$expiredDate])
            ->get();

        return view('Report.Report', compact('reportlist'))->with('data', $data)->with('expiredDate',$expiredDate)->with('exportData', false);
    }

    public function exportPDFGenerated($exportData, $expiredDate)    
    {

        if ($exportData) {

            if ($exportData == 'GeneratedReport') {
                // Query for generated report
                $data = DB::table('scheduledwaste')
                ->orderBy('scheduledwaste.id', 'desc')
                ->join('users', 'users.id','=','scheduledwaste.pic')
                ->join('transporter', 'transporter.id','=','scheduledwaste.transporter')
                ->join('receiver', 'receiver.id','=','scheduledwaste.companyreceiver')
                ->select([
                    'users.id AS userID',
                    'transporter.id AS transID',
                    'scheduledwaste.id AS swListID',
                    'receiver.id AS receiveID',
                    'users.*', 'scheduledwaste.*', 'transporter.*', 'receiver.*',
                    'transporter.fullname AS transporterName'
                ])
                ->where('expiredDate', [$expiredDate])
                ->get();
            } else {
                // Handle other cases if needed
                // For example, if no button is clicked
                $data = null;
            }
        } else {
            $data = null;
        }

        // Generate HTML table markup
        $table = '<h3>Scheduled Waste Record</h3>';
        $table .= '<table style="border-collapse: collapse; width: 100%;">';
        $table .= '<thead>';

        $table .= '<tr>';
        $table .= '<th style="border: 1px solid #000; padding: 8px; text-align: left;">ID</th>';
        foreach ($data as $record) {
        $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $record->id . '</td>';
        }
        $table .= '</tr>';

        $table .= '<tr>';
        $table .= '<th style="border: 1px solid #000; padding: 8px; text-align: left;">Waste Code</th>';
        foreach ($data as $record) {
        $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $record->wastecode . '</td>';
        }
        $table .= '</tr>';

        $table .= '<tr>';
        $table .= '<th style="border: 1px solid #000; padding: 8px; text-align: left;">Weight(mt)</th>';
        foreach ($data as $record) {
        $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $record->weight . '</td>';
        }
        $table .= '</tr>';

        $table .= '<tr>';
        $table .= '<th style="border: 1px solid #000; padding: 8px; text-align: left;">Waste Description</th>';
        foreach ($data as $record) {
        $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $record->wastedescription . '</td>';
        }
        $table .= '</tr>';

        $table .= '<tr>';
        $table .= '<th style="border: 1px solid #000; padding: 8px; text-align: left;">Disposal Site</th>';
        foreach ($data as $record) {
        $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $record->disposalsite . '</td>';
        }
        $table .= '</tr>';

        $table .= '<tr>';
        $table .= '<th style="border: 1px solid #000; padding: 8px; text-align: left;">Waste Type</th>';
        foreach ($data as $record) {
        $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $record->wastetype . '</td>';
        }
        $table .= '</tr>';

        $table .= '<tr>';
        $table .= '<th style="border: 1px solid #000; padding: 8px; text-align: left;">Packaging</th>';
        foreach ($data as $record) {
        $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $record->packaging . '</td>';
        }
        $table .= '</tr>';

        $table .= '<tr>';
        $table .= '<th style="border: 1px solid #000; padding: 8px; text-align: left;">Physical State</th>';
        foreach ($data as $record) {
        $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $record->state . '</td>';
        }
        $table .= '</tr>';

        $table .= '<tr>';
        $table .= '<th style="border: 1px solid #000; padding: 8px; text-align: left;">Person In Charge</th>';
        foreach ($data as $record) {
        $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $record->fullname . '</td>';
        }
        $table .= '</tr>';

        $table .= '<tr>';
        $table .= '<th style="border: 1px solid #000; padding: 8px; text-align: left;">Waste Generated Date</th>';
        foreach ($data as $record) {
        $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $record->wasteDate . '</td>';
        }
        $table .= '</tr>';

        $table .= '<tr>';
        $table .= '<th style="border: 1px solid #000; padding: 8px; text-align: left;">Waste Expired Date</th>';
        foreach ($data as $record) {
        $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $record->expiredDate . '</td>';
        }
        $table .= '</tr>';

        $table .= '<tr>';
        $table .= '<th style="border: 1px solid #000; padding: 8px; text-align: left;">Transporter</th>';
        foreach ($data as $record) {
        $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $record->transporterName . '</td>';
        }
        $table .= '</tr>';

        $table .= '<tr>';
        $table .= '<th style="border: 1px solid #000; padding: 8px; text-align: left;">Receiver</th>';
        foreach ($data as $record) {
        $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $record->companyname . '</td>';
        }
        $table .= '</tr>';

        $table .= '</tbody>';
        $table .= '</table>';

        // Generate PDF using Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($table);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Generate a unique filename for the PDF
        $filename = 'Report_' . time() . '.pdf';

        // Save the PDF to storage/app/public directory
        $dompdf->stream($filename);

        // Return the file download response
        return response()->download(public_path('storage/' . $filename))->deleteFileAfterSend(true);
    }

    public function exportPDFAll($exportData)
    {

        if ($exportData) {

            if ($exportData == 'AllReport') {
                // Query for generated report
                $data = DB::table('scheduledwaste')
                ->orderBy('scheduledwaste.id', 'desc')
                ->join('users', 'users.id','=','scheduledwaste.pic')
                ->join('transporter', 'transporter.id','=','scheduledwaste.transporter')
                ->join('receiver', 'receiver.id','=','scheduledwaste.companyreceiver')
                
                ->get();
            } else {
                // Handle other cases if needed
                // For example, if no button is clicked
                $data = null;
            }
        } else {
            $data = null;
        }

        // Generate HTML table markup
        $table = '<h3>Record List</h3>';
        $table .= '<table style="border-collapse: collapse; width: 100%;">';
        $table .= '<thead>';
        $table .= '<tr>';
        $table .= '<th style="border: 1px solid #000; padding: 8px;">ID</th>';
        $table .= '<th style="border: 1px solid #000; padding: 8px;">Waste Code</th>';
        $table .= '<th style="border: 1px solid #000; padding: 8px;">Weight(mt)</th>';
        $table .= '<th style="border: 1px solid #000; padding: 8px;">Waste Description</th>';
        $table .= '<th style="border: 1px solid #000; padding: 8px;">Disposal Site</th>';
        $table .= '<th style="border: 1px solid #000; padding: 8px;">Waste Type</th>';
        $table .= '<th style="border: 1px solid #000; padding: 8px;">Packaging</th>';
        $table .= '<th style="border: 1px solid #000; padding: 8px;">Physical State</th>';
        $table .= '<th style="border: 1px solid #000; padding: 8px;">Person In Charge</th>';
        $table .= '<th style="border: 1px solid #000; padding: 8px;">Waste Generated Date</th>';
        $table .= '<th style="border: 1px solid #000; padding: 8px;">Waste Expired Date</th>';
        $table .= '<th style="border: 1px solid #000; padding: 8px;">Transporter</th>';
        $table .= '<th style="border: 1px solid #000; padding: 8px;">Receiver</th>';
        $table .= '</tr>';
        $table .= '</thead>';
        $table .= '<tbody>';

        foreach ($data as $record) {
            $table .= '<tr>';
            $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $record->id . '</td>';
            $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $record->wastecode . '</td>';
            $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $record->weight . '</td>';
            $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $record->wastedescription . '</td>';
            $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $record->disposalsite . '</td>';
            $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $record->wastetype . '</td>';
            $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $record->packaging . '</td>';
            $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $record->state . '</td>';
            $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $record->pic . '</td>';
            $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $record->wasteDate . '</td>';
            $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $record->expiredDate . '</td>';
            $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $record->transporter . '</td>';
            $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $record->companyreceiver . '</td>';

            $table .= '</tr>';
        }
        $table .= '</tbody>';
        $table .= '</table>';

        // Generate PDF using Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($table);
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();

        // Generate a unique filename for the PDF
        $filename = 'Report_' . time() . '.pdf';

        // Save the PDF to storage/app/public directory
        $dompdf->stream($filename);

        // Return the file download response
        return response()->download(public_path('storage/' . $filename))->deleteFileAfterSend(true);
    }


}
