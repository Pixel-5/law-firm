<?php


namespace App\Repository\Eloquent;


use App\Client;
use App\Company;
use App\Repository\ClientRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CompanyFileRepository extends AbstractBaseRepository implements ClientRepositoryInterface
{

    public function __construct(Company $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return bool|Model
     */
    public function update(int $id, array $attributes): bool
    {
        // TODO: Implement update() method.
    }

    public function getFile($id)
    {
        return $this->find($id);
    }

    public function storeFile(Request $request)
    {
        $docs                           = $request->file('docs');
        $number                         = Str::fileNumber();
        $name                           = $request->name;
        $doi                            = $request->doi;
        $email                          = $request->email;
        $entity                         = $request->entity;
        $director_name                  = $request->director_name;
        $physical_address               = $request->physical_address;
        $postal_address                 = $request->postal_address;
        $tel                            = $request->tel;
        $director_physical_address      = $request->director_physical_address;
        $preferred_contact              = $request->preferred_contact;
        $preferred_email                = $request->preferred_email;
        $director_postal_address        = $request->director_postal_address;
        $shareholders                   = $request->shareholders;
        $fax                            = $request->fax;
        $cell                           = $request->cell;
        $directors_physical_address     = $request->directors_physical_address;
        $preferred_invoice              = $request->preferred_invoice;
        $directors_postal_address       = $request->directors_postal_address;
        $alternative_contact            = $request->alternative_contact;
        $agreement_service              = $request->agreement_service == 'on';

        if (!empty($docs)){
            foreach ($docs as $doc){
                $file_name = $doc->getClientOriginalName();
                Storage::putFile('client/files/'.$number, $doc);
                $files[] = $file_name;
            }
        }
        $individual =  $this->create([
            'number'                        =>$number,
            'name'                          => $name,
            'doi'                           =>$doi,
            'entity'                        =>$entity,
            'physical_address'              =>$physical_address,
            'postal_address'                =>$postal_address,
            'director_name'                 =>$director_name,
            'director_physical_address'     =>$director_physical_address,
            'director_postal_address'       =>$director_postal_address,
            'tel'                           =>$tel,
            'cell'                          =>$cell,
            'fax'                           =>$fax,
            'email'                         =>$email,
            'shareholders'                  =>$shareholders,
            'preferred_email'               =>$preferred_email,
            'preferred_contact'             =>$preferred_contact,
            'directors_physical_address'    =>$directors_physical_address,
            'directors_postal_address'      =>$directors_postal_address,
            'alternative_contact'           =>$alternative_contact,
            'preferred_invoice'             =>$preferred_invoice,
            'docs'                          => is_null($docs) ? "" : implode(",",$files),
            'agreement_service'             => $agreement_service,
        ]);

        $client = Client::create([
            'clientable_id' => $individual->id,
            'clientable_type' => 'App\Company'
        ]);
        return $client;
    }
}
