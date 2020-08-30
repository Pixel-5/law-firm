<?php


namespace App\Http\View\Composers;


use App\Facade\CaseRepository;
use App\Facade\ConveyancingRepository;
use App\Facade\LitigationRepository;
use Illuminate\View\View;

class CaseComposer
{
    public function compose(View $view)
    {
        return $view->with( [
//            'myUnScheduledCases'=>$this->myUnScheduledCases(),
//            'cases' => $this->allCases(),
//            'scheduledCases'=> $this->scheduledCases(),
//            'unScheduledCases' => $this->unscheduledCases(),
//            'unAssignedCases' => $this->unAssignedCases(),
                'assignedCases' => $this->assignedCases(),
//            'pendingCases' => $this->pendingCases(),
            'myLitigation' => $this->myLitigation(),
            'myConveyancing' =>$this->myConveyancing()
        ]);
    }

    public function myUnScheduledCases(){
        return CaseRepository::myUnScheduledCases();
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
        return CaseRepository::unscheduledCases();
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
