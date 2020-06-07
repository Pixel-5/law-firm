<?php


namespace App\Repository\Eloquent;


use App\QueryFilters\EndTime;
use App\QueryFilters\Schedule;
use App\QueryFilters\StartTime;
use App\Repository\UserRepositoryInterface;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

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



    public function getUser(int $id)
    {
        $user = $this->model->findOrFail($id);
        $user->load(['roles','profile']);
        if (!empty($user->roles) && $user->roles->first()->title === 'Lawyer'){
            $user->loadCount('cases');
        }
        return $user;
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

    public function updateUser(Request $request, int $id)
    {
        $user = $this->find($id);
        $request->password = $request->has('password') ? Hash::make($request->password) : $user->password;
        return $this->update($id, array_filter($request->all()));
    }

    /**
     * @param int   $id
     * @param array $attributes
     *
     * @return bool|Model
     */
    public function update($id, array $attributes): Bool
    {
        return $this->find($id)->update($attributes);
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
