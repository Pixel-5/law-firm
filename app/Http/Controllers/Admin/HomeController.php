<?php

namespace App\Http\Controllers\Admin;

use App\Facade\ScheduleRepository;

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
        return view('admin.client.cases');
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
        return view('admin.client.cases.pending');
    }
}
