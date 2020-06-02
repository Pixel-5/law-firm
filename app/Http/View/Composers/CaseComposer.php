<?php


namespace App\Http\View\Composers;


use App\Facade\CaseRepository;
use Illuminate\View\View;

class CaseComposer
{
    public function compose(View $view)
    {
        return $view->with( [
            'myCases'=> $this->myCourtCases(),
            'myUnScheduledCases'=>$this->myUnScheduledCases(),
            'cases' => $this->allCases(),
            'scheduledCases'=> $this->scheduledCases(),
            'unScheduledCases' => $this->unscheduledCases(),
            'unAssignedCases' => $this->unAssignedCases(),
        ]);
    }

    public function myUnScheduledCases(){
        return CaseRepository::myUnScheduledCases();
    }

    public function myCourtCases()
    {
        return CaseRepository::myCases();
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
}
