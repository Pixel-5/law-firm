<?php


namespace App\Http\View\Composers;



use App\Facade\CaseRepository;
use App\Facade\ClientRepository;
use App\Facade\FileRepository;
use App\Facade\IndividualFileRepository;
use Illuminate\View\View;

class FileComposer
{
    public function compose(View $view)
    {
        return $view->with([
            'clients' => $this->getClients(),
            'myClients'   => $this->myClients(),
            'individuals' => $this->countIndividuals(),
            'companies'      => $this->countCompanies(),
            'retainers'    => $this->countRetainers(),
            ] );
    }

    public function getClients()
    {
        return ClientRepository::clients();
    }
    public function myClients()
    {
        return FileRepository::myClients();
    }

    public function countIndividuals()
    {
        $count = 0;
        foreach (ClientRepository::clients() as $client){
            if ($client->clientable_type == 'App\Individual'){
                $count += 1;
            }
        }
        return $count;
    }

    public function countCompanies()
    {
        $count = 0;
        foreach (ClientRepository::clients() as $client){
            if ($client->clientable_type == 'App\Company'){
                $count += 1;
            }
        }
        return $count;
    }

    public function countRetainers()
    {
        $count = 0;
        foreach (ClientRepository::clients() as $client){
            if ($client->clientable_type == 'App\Retainer'){
                $count += 1;
            }
        }
        return $count;
    }
}
