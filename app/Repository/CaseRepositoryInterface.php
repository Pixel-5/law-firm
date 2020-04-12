<?php


namespace App\Repository;


use Illuminate\Support\Collection;

interface CaseRepositoryInterface
{
    public function showCase(int $id);

    public function storeCase(array $attributes);

    public function deleteCase(int $id);

    public function updateCase(int $id, array $attributes);

    public function allCases();
}
