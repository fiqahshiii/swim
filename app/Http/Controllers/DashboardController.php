<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //authorize session from user type
    public function loadDashboard()
    {
        $category = Auth::user()->category;

        if ($category == 'Employee') {
            return view('dashboard.employee');
        }
        if ($category == 'Manager') {
            return view('dashboard.manager');
        }
        if ($category == 'Admin') {
            //dd(Auth::user()->id);
            return view('dashboard.admin');
        }
    }
}
