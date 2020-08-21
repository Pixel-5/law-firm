<?php


namespace App\Http\View\Composers;



use App\Facade\CaseRepository;
use App\Facade\FileRepository;
use App\Facade\IndividualFileRepository;
use Illuminate\View\View;

class FileComposer
{
    public function compose(View $view)
    {
        return $view->with([
            'individuals' => $this->getIndividualFiles(),
            'companies'   => $this->getIndividualFiles(),
            'retainers'   => $this->getIndividualFiles(),
            'myClients'   => $this->myClients(),

            ] );
    }

    public function getIndividualFiles()
    {
        return IndividualFileRepository::individuals();;
    }
    public function getCompanyFiles()
    {
        return IndividualFileRepository::allFiles();
    }
    public function getRetainerFiles()
    {
        return IndividualFileRepository::allFiles();;
    }
    public function myClients()
    {
        return FileRepository::myClients();
    }
}
