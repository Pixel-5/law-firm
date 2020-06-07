<?php

namespace App\Http\Controllers;

use App\Facade\UserRepository;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param int               $id
     *
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, $id)
    {
        if (UserRepository::updateUser($request,$id)){
            return redirect()->back()->with('status','Successfully updated profile');
        }
        return redirect()->back()->with('status','Failed to upload a profile');
    }
}
