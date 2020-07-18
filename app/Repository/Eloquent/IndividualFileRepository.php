<?php


namespace App\Repository\Eloquent;


use App\File;
use App\Individual;
use App\Repository\FileRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class IndividualFileRepository extends AbstractBaseRepository implements FileRepositoryInterface
{

    public function __construct(Individual $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return bool|\App\Repository\Model
     */
    public function update(int $id, array $attributes): bool
    {
        // TODO: Implement update() method.
    }

    /**
     * @return Collection
     */
    public function allFiles(): Collection
    {
        // TODO: Implement allFiles() method.
    }

    /**
     * @param $request
     * @return \App\Repository\Model
     */
    public function storeFile($request)
    {
        $docs               = $request->file('docs');
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
        $agreement_service  = $request->agreement_service == 'on';

        if (!empty($docs)){
            foreach ($docs as $doc){
                $file_name = $doc->getClientOriginalName();
                Storage::putFile('client/files/'.$number, $doc);
                $files[] = $file_name;
            }
        }
        return  $this->create([

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
            'docs'              => is_null($docs) ? "" : implode(",",$files),
            'agreement_service' => $agreement_service,
        ]);
    }

    /**
     * @param $file
     * @return mixed
     */
    public function deleteFile($file)
    {
        // TODO: Implement deleteFile() method.
    }

    /**
     * @param $id
     * @return \App\Repository\Model|null
     */
    public function findById($id)
    {
        // TODO: Implement findById() method.
    }

    /**
     * @param $file
     * @param $request
     * @return \App\Repository\Model
     */
    public function updateFile($file, $request)
    {
        // TODO: Implement updateFile() method.
    }
}