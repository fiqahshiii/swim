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
//scheduled waste , docs
Route::get('/wastelist', [App\Http\Controllers\WasteController::class, 'ListWaste'])->name('swlist');
Route::get('/newwaste', [App\Http\Controllers\WasteController::class, 'NewWaste'])->name('wasteEmp');//wasteEmp--> tak kisah nama apa2 yang kita nak panggil tu dekat next page
Route::post('/insertnewwaste', [App\Http\Controllers\WasteController::class, 'insertnewwaste'])->name('insertnewwaste');
Route::delete('/deleteWaste/{id}', [App\Http\Controllers\WasteController::class, 'deletewaste'])->name('deletewaste');//account nama dekat route sidenav
Route::get('/displayWaste/{id}', [App\Http\Controllers\WasteController::class, 'displaywaste'])->name('displaywaste');//account nama dekat route sidenav
Route::get('/editWaste/{id}', [App\Http\Controllers\WasteController::class, 'EditWaste'])->name('editwaste');//account nama dekat route sidenav
Route::put('/UpdatedWaste/{id}', [App\Http\Controllers\WasteController::class, 'UpdatedWaste'])->name('updatedwaste');//account nama dekat route sidenav

//docs
Route::get('/filelist', [App\Http\Controllers\DocumentController::class, 'ListofFile'])->name('swfile');
Route::get('/newfilelist', [App\Http\Controllers\DocumentController::class, 'NewFile'])->name('newSOPfile');
Route::post('/insertDoc', [App\Http\Controllers\DocumentController::class, 'insertdocument'])->name('insertDoc');
Route::get('/displayDoc/{id}', [App\Http\Controllers\DocumentController::class, 'displayDoc'])->name('displayDoc');//account nama dekat route sidenav



//calendar
Route::get('/calendar', [App\Http\Controllers\CalendarController::class, 'empCalendar'])->name('calendar');
//transporter
Route::get('/transporterlist', [App\Http\Controllers\TransporterController::class, 'ListTransporter'])->name('translist');
Route::get('/newtransporter', [App\Http\Controllers\TransporterController::class, 'NewTransporter'])->name('newtransporter');
Route::post('/inserttransporter', [App\Http\Controllers\TransporterController::class, 'inserttransporter'])->name('inserttransporter');

//admin
Route::get('/userlist', [App\Http\Controllers\AccountController::class, 'UserList'])->name('userlist');
Route::get('/displayuser/{id}', [App\Http\Controllers\AccountController::class, 'displayUser'])->name('displayuser');//account nama dekat route sidenav
Route::get('/deleteuser/{id}', [App\Http\Controllers\AccountController::class, 'deleteuser'])->name('deleteUser');//account nama dekat route sidenav














