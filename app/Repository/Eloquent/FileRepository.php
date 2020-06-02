<?php


namespace App\Repository\Eloquent;


use App\File;
use App\Repository\FileRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class FileRepository
 * @package App\Repository\Eloquent
 */
class FileRepository extends AbstractBaseRepository implements FileRepositoryInterface
{
    /**
     * FileRepository constructor.
     * @param Model $model
     */
    public function __construct(File $model)
    {
        parent::__construct($model);
    }

    /**
     * @return array|Builder[]|Collection
     */
    public function allFiles(): Collection
    {
        return $this->model->with('cases')->get();
    }

    /**
     * @param $request
     * @return Model
     */
    public function storeFile($request): Model
    {
        $docs               = $request->file('docs');
        $file_no            = Str::fileNumber();
        $name               = $request->name;
        $surname            = $request->surname;
        $email              = $request->email;
        $contact            = $request->contact;
        $gender             = $request->gender;
        $physical_address   = $request->physical_address;
        $postal_address     = $request->postal_address;
        $dob                = $request->dob;

        if (!empty($docs)){
            foreach ($docs as $doc){
                $file_name = $doc->getClientOriginalName();
                Storage::putFile('client/files/'.$file_no, $doc);
                $files[] = $file_name;
            }
        }
         return  $this->create([

                    'number'            => $file_no,
                    'name'              => $name,
                    'surname'           => $surname,
                    'email'             => $email,
                    'dob'               => $dob,
                    'contact'           => $contact,
                    'postal_address'    => $postal_address,
                    'physical_address'  => $physical_address,
                    'gender'            => $gender,
                    'docs'              => is_null($docs) ? "" : implode(",",$files),
             ]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteFile($id)
    {
        return $this->delete($id);
    }

    /**
     * @param $id
     * @return Model
     */
    public function findById($id): Model
    {
        return $this->find($id)->load('cases');
    }

    /**
     * @param $id
     * @param $request
     * @return Model
     */
    public function updateFile($id, $request): Model
    {
        return $this->update($id,$request->all());
    }

    /**
     * @inheritDoc
     */
    public function update($id, array $attributes): Model
    {
        $file = $this->find($id);
        $file->update($attributes);
        return $file;
    }
    public function myClients()
    {
        return $this->model->whereHas('cases', function (Builder $query) {
            $query->where('user_id',Auth::user()->id);
        })->get();
    }
}
