<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Gate;

class HomeController
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function openFile()
    {
        return view('admin.client.open-file');
    }

    public function openCases()
    {
        return view('client.cases');
    }

    public function assignCases()
    {
        return view('admin.lawyer.assign-case');
    }

    public function reAssignCases()
    {
        return view('admin.client.re-assign-case');
    }

    public function pendingCases()
    {
        return view('client.cases.pending');
    }

    public function activityLogs()
    {
        return view('admin.activity_log');
    }

    public function profile()
    {
        return view('profile');
    }
}
