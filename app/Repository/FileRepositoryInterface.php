<?php


namespace App\Repository;

use Illuminate\Support\Collection;

interface FileRepositoryInterface
{
    /**
     * @return Collection
     */
    public function allFiles();

    /**
     * @param $request
     * @return Model
     */
    public function storeFile($request);

    /**
     * @param $file
     * @return mixed
     */
    public function deleteFile($file);

    /**
     * @param $id
     * @return Model|null
     */
    public function findById($id);

    /**
     * @param $file
     * @param $request
     * @return Model
     */
    public function updateFile($file, $request);
}
