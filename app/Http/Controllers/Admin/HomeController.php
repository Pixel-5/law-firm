<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Conveyancing;
use App\Facade\CaseRepository;
use App\Facade\ClientRepository;
use App\Facade\ConveyancingRepository;
use App\Facade\LitigationRepository;
use App\Litigation;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Models\Activity;

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

    public function chart(): JsonResponse
    {
        $data = ClientRepository::getChartData();
        return response()->json($data);
    }

    public function showDeletedLitigation($id,$activity)
    {
        Activity::find($activity)->update([
            'status' => 'reviewed'
        ]);
        $file = Litigation::onlyTrashed()
            ->where('id', $id)
            ->with([
                'client',
                'client.clientable',
                'client.spouse',
                'schedule',
                'notes',
                'consultation',
                'user'
            ])
            ->first();
        Session::put('deleted','retrieve');
        return view('lawyer.litigation.show')->with([
            'file' => $file,
            'activity' => $activity
        ]);
    }

    public function showDeletedConveyancing($id)
    {
        $litigation =  Conveyancing::onlyTrashed()
            ->where('id', 1)
            ->with([
                'client',
                'client.clientable',
                'client.spouse',
                'schedule',
                'notes',
                'consultation',
                'user'
            ])
            ->get();
        Session::put('deleted','retrieve');
    }

    public function showDeletedClient($id)
    {
        $litigation =  Client::onlyTrashed()
            ->where('id', 1)
            ->get();
        Session::put('review','review');
    }

    public function showUpdatedLitigation($id,$activity)
    {
       Activity::find($activity)->update([
            'status' => 'reviewed'
        ]);
        $file = LitigationRepository::getLitigation($id);
        return view('lawyer.litigation.show',compact('file'));
    }

    public function showUpdatedConveyancing($id, $activity)
    {
        Activity::find($activity)->update([
            'status' => 'reviewed'
        ]);
        $file = ConveyancingRepository::getConveyancing($id);
        return view('admin.client.conveyancing.show',compact('file'));
    }

    public function showUpdatedClient()
    {
    }

    public function resolveActivity($activity)
    {
        Activity::find($activity)->update([
            'status' => 'resolved'
        ]);
        return redirect()->back()->with('status','Successfully resolved an activity');
    }

    public function restoreDeletedLitigation($id,$activity)
    {
        $restored =  Litigation::onlyTrashed()
            ->where('id', $id)
            ->restore();
        if ($restored){
            Activity::find($activity)->update([
                'status' => 'retrieved'
            ]);
            $file = LitigationRepository::getLitigation($id);
            return redirect()->route('lawyer.litigation.show',$file)
                ->with([
                    'status'=>'Successfully restored a deleted Litigation file',
                ]);
        }
        return $this->showDeletedLitigation($id,$activity);
    }
}
