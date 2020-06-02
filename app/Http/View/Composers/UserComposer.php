<?php


namespace App\Http\View\Composers;


use App\Facade\UserRepository;
use Illuminate\View\View;

//user composer
class UserComposer
{
    public function compose(View $view)
    {
        return $view->with('lawyers', UserRepository::allUsers());
    }
}
