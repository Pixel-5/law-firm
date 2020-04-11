<?php


namespace App\Repositories;


use App\File;
use App\Http\Requests\StoreFileRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileRepository
{
    public function all()
    {
        $files = File::all();
        if (!empty($files)){
            $files = $files->load('cases');
        }
        return $files;
    }

    public function storeData($request)
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
                Storage::putFile('client/'.$file_no, $doc);
                $files[] = $file_name;
            }
        }
        File::create([
            'number'            => $file_no,
            'name'              => $name,
            'surname'           => $surname,
            'email'             => $email,
            'dob'               => $dob,
            'contact'           => $contact,
            'postal_address'    => $postal_address,
            'physical_address'  => $physical_address,
            'gender'            => $gender,
            'docs'              => is_null($docs) ? "" : implode(" ",$files),
        ]);
        return true;
    }

    public function deleteFile($file)
    {
        $file->delete();
    }

    public function updateFile($file, $request)
    {
        $file->update($request->all());
    }
}
