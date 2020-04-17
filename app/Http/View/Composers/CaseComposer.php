<?php


namespace App\Http\View\Composers;


use App\Facade\CaseRepository;
use Illuminate\View\View;

class CaseComposer
{
    public function compose(View $view)
    {
        return $view->with('cases', CaseRepository::myCases());
    }
}
