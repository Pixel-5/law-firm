<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Gate;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Where to redirect users after login.
     *
     * @return RedirectResponse
     */

    public function redirectPath()
    {
        switch (auth()->user()->roles){
            case 'Admin':
                return redirect()->route(RouteServiceProvider::ADMIN);

            case 'Lawyer':
                return redirect()->route(RouteServiceProvider::LAWYER);

            case 'SuperAdmin':
                return redirect()->route(RouteServiceProvider::SUPER);

            default:
                abort_if(Gate::denies('system_access'),
                    Response::HTTP_UNAUTHORIZED);

        }
    }
}
