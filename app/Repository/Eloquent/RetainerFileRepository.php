<?php


namespace App\Repository\Eloquent;


use App\Client;
use App\Company;
use App\Individual;
use App\Repository\RetainerFileRepositoryInterface;
use App\Retainer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Facade\IndividualFileRepository;
use App\Facade\CompanyFileRepository;
use Illuminate\Support\Str;

class RetainerFileRepository extends AbstractBaseRepository implements RetainerFileRepositoryInterface
{

    public function __construct(Retainer $model)
    {
        parent::__construct($model);
    }

    public function storeFile(Request $request)
    {
        $retainer = null;
        switch ($request->type){
            case 'individual':
                $individual = $this->createIndividual($request);
                $retainer = $this->create([
                    'number'         => Str::caseNumber(),
                    'individuals_id' => $individual->id,
                    'type'           => 'individual'
                ]);
                break;
            case 'company':
                $company = $this->createCompany($request);
                $retainer = $this->create([
                    'number'          => Str::caseNumber(),
                    'companies_id'    =>$company->id,
                    'type'            => 'company'
                ]);
                break;

            case 'both':
                $company = $this->createCompany($request);
                $individual = $this->createIndividual($request);
                $retainer = $this->create([
                    'number'            => Str::caseNumber(),
                    'individuals_id'    => $individual->id,
                    'companies_id'      =>$company->id,
                    'type'              => 'both'
                ]);
                break;
            default:
                throw new \Exception('Unexpected value');
        }
        $client = Client::create([
            'clientable_id' => $retainer->id,
            'clientable_type' => 'App\Retainer',
        ]);
        return $client;
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

    public function createCompany(Request $request)
    {
        $number                         = Str::fileNumber();
        $name                           = $request->cname;
        $doi                            = $request->doi;
        $email                          = $request->cemail;
        $entity                         = $request->entity;
        $director_name                  = $request->director_name;
        $physical_address               = $request->cphysical_address;
        $postal_address                 = $request->cpostal_address;
        $tel                            = $request->ctel;
        $director_physical_address      = $request->director_physical_address;
        $preferred_contact              = $request->cpreferred_contact;
        $preferred_email                = $request->cpreferred_email;
        $director_postal_address        = $request->director_postal_address;
        $shareholders                   = $request->shareholders;
        $fax                            = $request->cfax;
        $cell                           = $request->ccell;
        $directors_physical_address     = $request->directors_physical_address;
        $preferred_invoice              = $request->cpreferred_invoice;
        $directors_postal_address       = $request->directors_postal_address;
        $alternative_contact            = $request->calternative_contact;

        $company = Company::create([
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
        ]);

        return $company;
    }

    public function createIndividual(Request $request)
    {
        $number             = Str::fileNumber();
        $name               = $request->name;
        $surname            = $request->surname;
        $email              = $request->email;
        $identifier         = $request->identifier;
        $gender             = $request->gender;
        $physical_address   = $request->physical_address;
        $postal_address     = $request->postal_address;
        $tel                = $request->tel;
        $marital_status     = $request->marital_status;
        $preferred_contact  = $request->preferred_contact;
        $preferred_email    = $request->preferred_email;
        $dob                = $request->dob;
        $name_next_kin      = $request->name_next_kin;
        $fax                = $request->fax;
        $cell               = $request->cell;
        $contact_next_kin   = $request->contact_next_kin;
        $preferred_invoice  = $request->preferred_invoice;
        $nationality        = $request->nationality;
        $is_citizen         = $request->is_citizen == 'Yes';
        $occupation         = $request->occupation;

        return Individual::create([
            'name'              => $name,
            'number'            =>$number,
            'surname'           =>$surname,
            'dob'               =>$dob,
            'identifier'        =>$identifier,
            'gender'             =>$gender,
            'physical_address'  =>$physical_address,
            'postal_address'    =>$postal_address,
            'tel'               =>$tel,
            'cell'              =>$cell,
            'fax'               =>$fax,
            'email'             =>$email,
            'preferred_email'   =>$preferred_email,
            'preferred_contact' =>$preferred_contact,
            'marital_status'    =>$marital_status,
            'name_next_kin'     =>$name_next_kin,
            'contact_next_kin'  =>$contact_next_kin,
            'preferred_invoice' =>$preferred_invoice,
            'nationality'       =>$nationality,
            'is_citizen'        =>$is_citizen,
            'occupation'        =>$occupation,
        ]);
    }

}
