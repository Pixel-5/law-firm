<?php

namespace App\Repository;

use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function allUsers(): Collection;

    public function getLawyersOnly(): Collection;

    public function userSchedule($id);
}
