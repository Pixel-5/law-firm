<?php


namespace App\Repository\Eloquent;

use App\FileCase;
use App\Repository\CaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

/**
 * Class CaseRepository
 * @package App\Repository\Eloquent
 */
class CaseRepository extends AbstractBaseRepository implements CaseRepositoryInterface
{
    /**
     * CaseRepository constructor.
     * @param FileCase $model
     */
    public function __construct(FileCase $model)
    {
        parent::__construct($model);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function showCase($id)
    {
        return $this->find($id);
    }

    /**
     * @param Request $request
     * @return Model
     */
    public function storeCase($request)
    {
        $docs               = $request->file('docs');
        $case_no            = $request->number;
        $plaintiff          = $request->plaintiff;
        $defendant          = $request->defendant;
        $details            = $request->details;
        $file_id            = $request->file_id;

        if (!empty($docs)) {
            foreach ($docs as $doc) {
                $file_name = $doc->getClientOriginalName();
                Storage::putFile('client/cases/' . $case_no, $doc);
                $files[] = $file_name;
            }
        }
        return $this->create([
            'file_id'     => $file_id,
            'number'      => $case_no,
            'plaintiff'   => $plaintiff,
            'defendant'   => $defendant,
            'details'     => $details,
            'status'      => 'pending',
            'docs'        => is_null($docs) ? "" : implode(",", $files),
        ]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteCase($id)
    {
        return $this->delete($id);
    }

    /**
     * @inheritDoc
     */
    public function update($id, array $attributes): Bool
    {
        return $this->find($id)->update($attributes);
    }

    /**
     * @param $id
     * @param $request
     * @return Model
     */
    public function updateCase($id, $request)
    {
        return $this->update($id, $request);
    }

    public function pendingCases()
    {
        $results =  $this->model->with(['file'])->with('schedule')->get();
        $results = collect($results);
        return $results->whereNull('schedule');
    }

    public function allCases()
    {
        return $this->model->with(['file', 'user',])->cursor();
    }

    public function assignedCases()
    {
        return $this->model->whereHas('user')->with(['file', 'user'])->cursor();
    }

    public function scheduledCases()
    {
        return $this->model->whereHas('schedule')->with(['file', 'user'])->cursor();
    }

    public function unAssignedCases()
    {
        return $this->model->doesntHave('user')->with(['file'])->cursor();
    }

    public function unScheduledCases()
    {
        return $this->model->doesntHave('schedule')->with(['file'])->cursor();
    }
    public function myUnScheduledCases(): array
    {
        $myUnscheduledCases = array();
        $lawyer = Auth::user();
        $myCases = $this->model->where('user_id', $lawyer->id)->get();
        $myCases = $myCases->load(['file', 'schedule']);
        foreach ($myCases as $myCase) {
            if($myCase->schedule === null){
                $myUnscheduledCases[] = $myCase;
            }
        }
        return $myUnscheduledCases;
    }

    /**
     * @return mixed
     */
    public function myCases()
    {
        $lawyer = Auth::user();
        $myCases = $this->model->where('user_id', $lawyer->id)->get();
        $myCases = $myCases->load(['file', 'schedule']);
        return $myCases;
    }
}
