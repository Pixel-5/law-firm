<?php


namespace App\Http\View\Composers;


use App\Facade\CaseRepository;
use App\Facade\ClientRepository;
use App\Facade\ConveyancingRepository;
use App\Facade\LitigationRepository;
use Illuminate\View\View;

class CaseComposer
{
    public function compose(View $view)
    {
        return $view->with( [
            'myAssignedClients'=>$this->myAssignedClients(),
            'litigation' => $this->litigation(),
            'conveyancing'=> $this->conveyancing(),
            'myUnScheduledClients' => $this->unscheduledCases(),
            'assignedCases' => $this->assignedCases(),
            'pendingClients' => $this->pendingClients(),
            'myLitigation' => $this->myLitigation(),
            'myConveyancing' =>$this->myConveyancing(),
            'unAssignedClients'=>$this->unAssignedClients()
        ]);
    }

    public function myAssignedClients(){
        return ClientRepository::myAssignedClients();
    }

    public function myLitigation()
    {
        return LitigationRepository::getMyLitigation();
    }


    public function myConveyancing()
    {
        return ConveyancingRepository::getMyConveyancing();
    }

    public function litigation()
    {
        return LitigationRepository::allLitigation();
    }

    public function conveyancing()
    {
        return ConveyancingRepository::all();
    }

    public function unscheduledCases()
    {
        return ClientRepository::unscheduledCases();
    }

    public function unAssignedCases()
    {
        return CaseRepository::unAssignedCases();
    }
    public function assignedCases()
    {
        return LitigationRepository::getMyLitigation();
    }

    public function pendingClients()
    {
        return ClientRepository::pendingClients();
    }

    public function unAssignedClients()
    {
        return ClientRepository::unAssignedClients();
    }
}
