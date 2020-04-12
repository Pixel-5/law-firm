<?php


namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface EloquentRepositoryInterface
 * @package App\Repositories
 */

interface EloquentRepositoryInterface
{
    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model;

    /**
     * @param $id
     * @return void
     */
    public function delete($id);

    /**
     * @param $id
     * @param array $attributes
     * @return Model
     */
    public function update($id, array $attributes): Model;


}
