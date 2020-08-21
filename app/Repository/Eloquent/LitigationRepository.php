<?php


namespace App\Repository\Eloquent;


use App\Litigation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
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
        // TODO: Implement update() method.
    }

    public function createLitigation(Request $request)
    {
        return $this->create([
            'number'    =>Str::caseNumber(),
            'client_id' =>$request->client_id,
            'category'  =>$request->category,
        ]);
    }
}
