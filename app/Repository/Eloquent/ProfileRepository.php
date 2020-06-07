<?php


    namespace App\Repository\Eloquent;


    use App\Profile;
    use App\Repository\ProfileRepositoryInterface;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Storage;

    class ProfileRepository extends AbstractBaseRepository implements ProfileRepositoryInterface
    {

        /**
         * @inheritDoc
         */

        public function __construct(Profile $model)
        {
            parent::__construct($model);
        }

        public function uploadPhoto(Request $request, int $profile)
        {
            if (!empty($request->hasFile('photo'))){
                $photo = $request->file('photo');
                $userProfile = $this->find($profile);
                if (!empty($userProfile->photo)){
                    Storage::disk('public')->delete($userProfile->photo);
                }
                $path = Storage::disk('public')->putFile('profile' ,$photo);
            }
            return $this->update($profile,['photo' => $path]);
        }

        public function updateProfile(Request $request, int $profile)
        {
            return $this->update($profile, array_filter($request->all()));
        }

        public function update(int $id, array $attributes): Bool
        {
            return $this->find($id)->update($attributes);
        }
    }