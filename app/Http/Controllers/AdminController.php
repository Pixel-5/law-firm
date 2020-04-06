<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('admin.dashboard');
    }

    public function openFile(){
        return view('admin.client.open-file');
    }

    public function openCases(){
        return view('admin.client.cases');
    }

    public function assignCases(){
        return view('admin.client.schedule-lawyer');
    }

    public function reAssignCases(){
        return view('admin.client.re-assign-case');
    }

    public function pendingCases(){
        return view('admin.client.pending-cases');
        //return view('admin.client.schedule-lawyer');
    }
}
