<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index(){
        return view('lawyer.dashboard');
    }

    public function myCases(){
        return view('lawyer.assigned-cases');
    }

    public function pendingCases(){
        return view('lawyer.pending-cases');
    }

    public function mySchedule(){
        return view('lawyer.schedule-cases');
    }
}
