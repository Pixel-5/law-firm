<?php


namespace App\Http\View\Composers;



use App\Facade\FileRepository;
use App\Repository\Eloquent\UserRepository;
use Illuminate\View\View;

class FileComposer
{
    public function compose(View $view)
    {
        return $view->with('users', UserRepository::all());
    }
}
