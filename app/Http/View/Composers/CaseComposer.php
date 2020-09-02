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
//            'cases' => $this->allCases(),
//            'scheduledCases'=> $this->scheduledCases(),
            'myUnScheduledClients' => $this->unscheduledCases(),
//            'unScheduledConveyancing' => $this->unscheduledCases(),
//            'unAssignedCases' => $this->unAssignedCases(),
                'assignedCases' => $this->assignedCases(),
//            'pendingCases' => $this->pendingCases(),
            'myLitigation' => $this->myLitigation(),
            'myConveyancing' =>$this->myConveyancing()
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

    public function allCases()
    {
        return CaseRepository::allCases();
    }

    public function scheduledCases()
    {
        return CaseRepository::scheduledCases();
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

    public function pendingCases()
    {
        return CaseRepository::pendingCases();
    }


}
