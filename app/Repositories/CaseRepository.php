<?php


namespace App\Repositories;

use App\Facade\FileRepository;
use App\FileCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CaseRepository
{

    public function showCases($id)
    {
        return FileRepository::findById($id);
    }

    public function storeCase(Request $request)
    {
        $docs               = $request->file('docs');
        $case_no            = $request->number;
        $plaintiff          = $request->plaintiff;
        $defendant          = $request->defendant;
        $details            = $request->details;
        $date_appeal        = $request->date_appeal;
        $file_id            = $request->file_id;

        if (!empty($docs)){
            foreach ($docs as $doc){
                $file_name = $doc->getClientOriginalName();
                Storage::putFile('client/cases/'.$case_no, $doc);
                $files[] = $file_name;
            }
        }
       FileCase::create([
           'file_id'     => $file_id,
           'number'      => $case_no,
           'plaintiff'   => $plaintiff,
           'defendant'   => $defendant,
           'details'     => $details,
           'date_appeal' => $date_appeal,
           'status'      => 'pending',
           'docs'        => is_null($docs) ? "" : implode(",",$files),
       ]);

        return true;
    }
}
