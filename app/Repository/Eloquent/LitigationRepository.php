<?php


namespace App\Repository\Eloquent;


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

    public function deleteLitigation(int $id)
    {
        return $this->delete($id);
    }

    public function getLitigation()
    {
        return $this->model->whereHas('user')->with(['client', 'user'])->cursor();
    }

    public function getMyLitigation()
    {
        //Todo load schedule
        $myLitigation = $this->model->where('user_id', Auth::user()->id)->get();
        $myLitigation = $myLitigation->load(['client']);
        return $myLitigation;
    }
}
