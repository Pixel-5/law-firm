<?php


namespace App\Repository\Eloquent;


use App\FileNoteForm;
use App\InitialConsultationForm;
use App\Litigation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LitigationRepository extends AbstractBaseRepository
{

    public function __construct(Litigation $model)
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
        return $this->find($id)->update($attributes);
    }

    public function createLitigation(Request $request)
    {
        return $this->create([
            'number'    =>Str::caseNumber(),
            'client_id' =>$request->client_id,
            'category'  =>$request->category,
        ]);
    }

    public function allLitigation()
    {
        return $this->model->all();
    }

    public function deleteLitigation(int $id)
    {
        return $this->delete($id);
    }

    public function assignedLitigation()
    {
        return $this->model->whereHas('user')->with(['client', 'user'])->cursor();
    }

    public function getMyLitigation()
    {
        $myLitigation = $this->model->where('user_id', Auth::user()->id)->get();
        $myLitigation = $myLitigation->load(['client','schedule']);
        return $myLitigation;
    }

    public function getLitigation($id)
    {
        $myLitigation = $this->find($id);
        $myLitigation = $myLitigation->load(['client','schedule','notes','consultation','user']);
        return $myLitigation;
    }

    public function storeFormNote(Request $request)
    {
        return FileNoteForm::create($request->all());
    }

    public function storeInitialConsultation(Request $request)
    {
        return InitialConsultationForm::create($request->all());
    }

    public function storeFileNote(Request $request)
    {
        return FileNoteForm::create($request->all());
    }

    public function updateLitigation($id,$request)
    {
        return $this->update($id, $request);
    }

    public function updateInitialConsultation($id,$request)
    {
        $consultation = InitialConsultationForm::find($id);
        return $consultation->update($request);
    }

    public function updateFileNote($id,$request)
    {
        $note = FileNoteForm::find($id);
        return $note->update($request);
    }

    public function deleteFileNote($id)
    {
        $note = FileNoteForm::find($id);
        return $note->delete();
    }

    public function all()
    {
        $litigation = $this->model->all();
        $litigation = $litigation->load(['client','schedule']);
        return $litigation;
    }
}
