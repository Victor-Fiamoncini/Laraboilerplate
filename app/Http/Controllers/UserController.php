<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserUpdate as UserUpdateRequest;
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
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $userUpdateRequest, User $user)
    {
        dd($userUpdateRequest->all());
    }

}
