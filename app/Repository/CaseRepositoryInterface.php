<?php


namespace App\Repository;

interface CaseRepositoryInterface
{
    public function showCase(int $id);

    public function storeCase(array $attributes);

    public function deleteCase(int $id);

    public function updateCase(int $id, array $attributes);

    public function allCases();

    public function scheduledCases();

    public function myCases();
}
