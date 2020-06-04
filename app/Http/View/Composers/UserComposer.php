<?php


namespace App\Http\View\Composers;


use App\Facade\UserRepository;
use Illuminate\View\View;

//user composer
class UserComposer
{
    public function compose(View $view)
    {
        return $view->with([
            'lawyers' => $this->getLawyers(),
            'unreadNotifications' => $this->unreadNotifications(),
            'notifications' => collect($this->notifications())->paginate(3),
            ]);
    }

    public function getLawyers()
    {
        return UserRepository::getLawyersOnly();
    }

    public function unreadNotifications()
    {
        return auth()->user()->unreadNotifications;
    }

    public function notifications()
    {
        return auth()->user()->notifications;
    }
}
