<?php


namespace App\Repository\Eloquent;


use App\Company;
use App\Repository\ClientRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

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
}
