<?php

namespace App\Repository\Eloquent;

use App\Repository\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract  class AbstractBaseRepository implements EloquentRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * AbstractBaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param $id
     * @return Model
     */
    public function find(int $id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param $id
     * @param array $attributes
     * @return void
     */

    public function delete(int $id)
    {
        $this->model->find($id)->delete();
        return true;
    }

    /**
     * @inheritDoc
     */
    public abstract function update(int $id, array $attributes): Bool;
}
