<?php

namespace App\Http\Controllers;

use App\Facade\ProfileRepository;
use App\Facade\UserRepository;
use App\Http\Requests\UpdateProfileRequest;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */

    private $message = 'You do not have permission to';

    public function index()
    {
        abort_if(Gate::denies('profile_access'), Response::HTTP_FORBIDDEN,
            $this->message.' access profile');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        abort_if(Gate::denies('profile_create'), Response::HTTP_FORBIDDEN,
            $this->message.' create profile');
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
    public function show($profile)
    {
        abort_if(Gate::denies('profile_show'), Response::HTTP_FORBIDDEN,
            $this->message.'view  profile');
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
        abort_if(Gate::denies('profile_edit'), Response::HTTP_FORBIDDEN,
            $this->message.' edit profile');
        $user = UserRepository::getUser($profile);
        return view('edit-profile')->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProfileRequest $request
     * @param int                  $profile
     *
     * @return RedirectResponse
     */
    public function update(UpdateProfileRequest $request, $profile)
    {
        if ($request->hasFile('photo')){
            $user = ProfileRepository::uploadPhoto($request, $profile);
        }else{
            $user = ProfileRepository::updateProfile($request, $profile);
        }

        if (!empty($user)){
            return redirect()->back()->with('status','Successfully updated profile');
        }
        return redirect()->back()->with('status','Failed to upload a profile');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return Response
     */
    public function destroy(User $user)
    {
        abort_if(Gate::denies('schedule_access'), Response::HTTP_FORBIDDEN,
            $this->message.' delete profile');
    }
}
