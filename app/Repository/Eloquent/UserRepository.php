<?php


namespace App\Repository\Eloquent;


use App\QueryFilters\EndTime;
use App\QueryFilters\Schedule;
use App\QueryFilters\StartTime;
use App\Repository\UserRepositoryInterface;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;
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
    public function allUsers(): Collection
    {
        return $this->model->all();
    }

    public function getLawyer(int $id)
    {
        return $this->model->find($id);
    }

    public function getLawyersOnly(): Collection
    {
        return  $this->model->whereHas('roles', function (Builder $query) {
            $query->Where('title', 'lawyer');
        })->where('active_status', 1)->get();
    }

    /**
     * @inheritDoc
     */
    public function update($id, array $attributes): Model
    {
        // TODO: Implement update() method.
    }

    public function userSchedule($id)
    {
        return $this->find($id)->load('userSchedule');
    }

    public function checkUserSchedule(): array
    {
        $schedules = $this->userSchedule(request('user_id'))->userSchedule;

        foreach ($schedules as $schedule){
            $pipeline = app(Pipeline::class)
                ->send($schedule->query())
                ->through(array(
                    StartTime::class,
                    EndTime::class,
                    //Schedule::class
                ))
                ->thenReturn();
            if ($pipeline->first() !== null){
                return ['status' => $pipeline->first() !== null? $pipeline->first()->exists : false];
            }

        }
        return ['status' => false];
    }
}
