<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserUpdate as UserUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Return dashboard profile view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showProfilePage()
    {
        return view('pages.profile')->with('user', Auth::user());
    }

    /**
     * Update the specified user in storage
     *
     * @param App\Http\Requests\UserUpdate $userUpdateRequest
     * @param \App\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $userUpdateRequest, User $user)
    {
        if (empty($userUpdateRequest->password)) {
            $user->update($userUpdateRequest->except('password'));
        } else {
            $user->update($userUpdateRequest->all());
        }

        return redirect()->route('dashboard.profile')->with([
            'status' => 'success',
            'message' => $user->name . ', your informations are successfully updated!'
        ]);
    }

    /**
     * Update profile photo
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePhoto(Request $request, User $user)
    {
        return redirect()->route('dashboard.profile')->with([
            'status' => 'success',
            'message' => 'Profile photo updated successfully!'
        ]);
    }

}
