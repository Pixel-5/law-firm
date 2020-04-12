<?php


namespace App\Repository\Eloquent;


use App\Repository\UserRepositoryInterface;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class UserRepository extends AbstractBaseRepository implements UserRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    public function getLawyersOnly()
    {
        $users = User::whereHas('roles', function ($q) {
            $q->Where('name', 'lawyer');
        })->where('active_status', 1)->paginate(20);

        return $users;
    }

    /**
     * @inheritDoc
     */
    public function update($id, array $attributes): Model
    {
        // TODO: Implement update() method.
    }
}
