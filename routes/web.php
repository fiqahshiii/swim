<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//do not want to display welcome page 
Route::get('/', function () {
    if ($user = Auth::user()) {
        //if login
        return redirect('/dashboard');
    } else {
        //if not login
        return redirect('login');
    }
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');//nama kat url link / nama function / nama panggil kat interface
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'loadDashboard'])->name('dashboard');
//user
Route::get('/viewacc/{id}', [App\Http\Controllers\AccountController::class, 'AccountSetting'])->name('account');//account nama dekat route sidenav
Route::put('/updateprofile/{id}', [App\Http\Controllers\AccountController::class, 'UpdateProfile'])->name('updateprofile');//account nama dekat route sidenav
Route::get('/change-password', [App\Http\Controllers\AccountController::class, 'changePassword'])->name('change-password');
Route::post('/change-password', [App\Http\Controllers\AccountController::class, 'updatePassword'])->name('update-password');

//Attendnace
Route::get('/attendance', [App\Http\Controllers\AccountController::class, 'attendance'])->name('attendance');
Route::post('/checkIn', [App\Http\Controllers\AccountController::class, 'checkIn'])->name('checkIn');
Route::get('/checkOut/{id}', [App\Http\Controllers\AccountController::class, 'checkOut'])->name('checkOut');
Route::get('/EmpAttendance', [App\Http\Controllers\AccountController::class, 'ListAttendance'])->name('EmpAttendance');
Route::get('/attendDetails/{id}', [App\Http\Controllers\AccountController::class, 'attendDetailsEmp'])->name('attendDetails');


//scheduled waste , docs
Route::get('/wastelist', [App\Http\Controllers\WasteController::class, 'ListWaste'])->name('swlist');
Route::get('/pendingsw', [App\Http\Controllers\WasteController::class, 'pendingWaste'])->name('pendingsw');
Route::get('/disposedsw', [App\Http\Controllers\WasteController::class, 'disposedWaste'])->name('disposedsw');
Route::get('/newwaste', [App\Http\Controllers\WasteController::class, 'NewWaste'])->name('wasteEmp');//wasteEmp--> tak kisah nama apa2 yang kita nak panggil tu dekat next page
Route::post('/insertnewwaste', [App\Http\Controllers\WasteController::class, 'insertnewwaste'])->name('insertnewwaste');
Route::delete('/deleteWaste/{id}', [App\Http\Controllers\WasteController::class, 'deletewaste'])->name('deleteWaste');//account nama dekat route sidenav
Route::get('/displayWaste/{id}', [App\Http\Controllers\WasteController::class, 'displaywaste'])->name('displaywaste');//account nama dekat route sidenav
Route::get('/editWaste/{swListID}/{transID}/{receiveID}', [App\Http\Controllers\WasteController::class, 'EditWaste'])->name('editwaste');//account nama dekat route sidenav
Route::put('/UpdatedWaste/{id}', [App\Http\Controllers\WasteController::class, 'UpdatedWaste'])->name('updatedwaste');//account nama dekat route sidenav
Route::get('/wastelistManager', [App\Http\Controllers\WasteController::class, 'swlistManager'])->name('swlistManager');
Route::get('/moredetails/{id}', [App\Http\Controllers\WasteController::class, 'MoreDetails'])->name('moredetails');

//email
Route::get('/alertEmail/{id}', [App\Http\Controllers\WasteController::class, 'getEmail'])->name('getEmail');//account nama dekat route sidenav
Route::get('/alertEmailTrans/{id}', [App\Http\Controllers\TransporterController::class, 'getEmailTrans'])->name('getEmailTrans');//account nama dekat route sidenav

//filtering
Route::get('/filter', [App\Http\Controllers\WasteController::class, 'filter'])->name('filter');
Route::get('/getManagerEmail/{id}', [App\Http\Controllers\WasteController::class, 'getManagerEmail']);



//docs
Route::get('/filelist', [App\Http\Controllers\DocumentController::class, 'ListofFile'])->name('swfile');
Route::get('/newfilelist', [App\Http\Controllers\DocumentController::class, 'NewFile'])->name('newSOPfile');
Route::post('/insertDoc', [App\Http\Controllers\DocumentController::class, 'insertdocument'])->name('insertDoc');
Route::get('/displayDoc/{id}', [App\Http\Controllers\DocumentController::class, 'displayDoc'])->name('displayDoc');//account nama dekat route sidenav
Route::delete('/DeleteFile/{id}', [App\Http\Controllers\DocumentController::class, 'deletefile'])->name('deletefile');//account nama dekat route sidenav
Route::get('/editDoc/{id}', [App\Http\Controllers\DocumentController::class, 'editDoc'])->name('editDoc');//account nama dekat route sidenav
Route::put('/UpdatedDoc/{id}', [App\Http\Controllers\DocumentController::class, 'UpdatedDoc'])->name('UpdatedDoc');//account nama dekat route sidenav



//calendar
Route::get('/calendar', [App\Http\Controllers\CalendarController::class, 'empCalendar'])->name('calendar');
Route::get('/ManagerCalendar', [App\Http\Controllers\CalendarController::class, 'ManagerCalendar'])->name('ManagerCalendar');

//transporter
Route::get('/transporterlist', [App\Http\Controllers\TransporterController::class, 'ListTransporter'])->name('translist');
Route::get('/newtransporter', [App\Http\Controllers\TransporterController::class, 'NewTransporter'])->name('newtransporter');
Route::post('/inserttransporter', [App\Http\Controllers\TransporterController::class, 'inserttransporter'])->name('inserttransporter');
Route::get('/displaytransporter/{id}', [App\Http\Controllers\TransporterController::class, 'displaytrans'])->name('displaytrans');//account nama dekat route sidenav
Route::get('/editTransporter/{id}', [App\Http\Controllers\TransporterController::class, 'EditTransporter'])->name('editTransList');//account nama dekat route sidenav
Route::put('/UpdatedTransporter/{id}', [App\Http\Controllers\TransporterController::class, 'UpdatedTrans'])->name('UpdatedTrans');//account nama dekat route sidenav
Route::delete('/deleteTransporter/{id}', [App\Http\Controllers\TransporterController::class, 'deleteTransporter'])->name('deleteTransporter');//account nama dekat route sidenav

//admin
Route::get('/userlist', [App\Http\Controllers\AccountController::class, 'UserList'])->name('userlist');
Route::get('/displayuser/{id}', [App\Http\Controllers\AccountController::class, 'displayUser'])->name('displayuser');//account nama dekat route sidenav
Route::get('/deleteuser/{id}', [App\Http\Controllers\AccountController::class, 'deleteuser'])->name('deleteUser');//account nama dekat route sidenav

//receiver
Route::get('/newreceiver', [App\Http\Controllers\ReceiverController::class, 'NewReceiver'])->name('newreceiver');
Route::get('/receiverlist', [App\Http\Controllers\ReceiverController::class, 'ListReceiver'])->name('receiverlist');
Route::post('/insertreceiver', [App\Http\Controllers\ReceiverController::class, 'insertreceiver'])->name('insertreceiver');
Route::get('/displayReceiver/{id}', [App\Http\Controllers\ReceiverController::class, 'displayReceiver'])->name('displayReceiver');//account nama dekat route sidenav
Route::get('/editReceiver/{id}', [App\Http\Controllers\ReceiverController::class, 'EditReceiver'])->name('editReceiver');//account nama dekat route sidenav
Route::put('/UpdatedReceiver/{id}', [App\Http\Controllers\ReceiverController::class, 'UpdatedReceiver'])->name('UpdatedReceiver');//account nama dekat route sidenav
Route::delete('/deleteReceiver/{id}', [App\Http\Controllers\ReceiverController::class, 'deleteReceiver'])->name('deleteReceiver');//account nama dekat route sidenav

//report

Route::get('/report', [App\Http\Controllers\ReportController::class, 'report'])->name('report');
//generatereport
Route::get('/Report-Generated', [App\Http\Controllers\ReportController::class, 'generatereport'])->name('generatereport');
//export pdf 
Route::get('/export-pdf-generated/{exportData}/{expiredDate}', [App\Http\Controllers\ReportController::class, 'exportPDFGenerated'])->name('exportPDFGenerated');
//export pdf 
Route::get('/export-pdf-all/{exportData}', [App\Http\Controllers\ReportController::class, 'exportPDFAll'])->name('exportPDFAll');
//export excel 
Route::get('/export-excel-all/{exportData}', [App\Http\Controllers\ReportController::class, 'exportExcelAll'])->name('exportExcelAll');
//export excel 
Route::get('/export-excel-generated/{exportData}/{expiredDate}', [App\Http\Controllers\ReportController::class, 'exportExcelGenerated'])->name('exportExcelGenerated');








