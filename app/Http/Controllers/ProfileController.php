<?php

namespace App\Http\Controllers;

use App\Facade\UserRepository;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return void
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $profile
     *
     * @return View
     */
    public function show(int $profile)
    {
        $user = UserRepository::getUser($profile);
        return view('show-profile')->with('user',$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $profile
     * @return View
     */
    public function edit(int $profile)
    {
        $user = UserRepository::getUser($profile);
        return view('edit-profile')->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request    $request
     * @param  \App\User $user
     *
     * @return Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return Response
     */
    public function destroy(User $user)
    {
        //
    }
}
