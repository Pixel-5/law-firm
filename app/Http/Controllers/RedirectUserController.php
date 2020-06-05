<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class RedirectUserController extends Controller
{
    public const ADMIN =  'admin.dashboard';
    public const LAWYER = 'lawyer.dashboard';
    public const LOGIN = '/login';

    public function __invoke()
    {
        if (Auth::user() === null){
            return redirect()->to(self::LOGIN);
        }
        $role = Auth::user()->roles->first();
        switch ($role->title){
            case 'Super':
            case 'Admin':
                return redirect()->route(self::ADMIN);

            case 'Lawyer':
                return redirect()->route(self::LAWYER);

            default:
                auth()->logout();
                abort_if(Gate::denies('system_access'),
                    Response::HTTP_UNAUTHORIZED);
        }
   }
}
