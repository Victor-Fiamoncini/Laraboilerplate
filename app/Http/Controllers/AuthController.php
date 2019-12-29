<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRegister as UserRegisterRequest;

class AuthController extends Controller
{
    /**
     * Return login view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginPage()
    {
        return view('pages.login');
    }

    /**
     * Return register user view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegisterPage()
    {
        return view('pages.register');
    }

    /**
     * Register a new user into database
     *
     * @param App\Http\Requests\UserRegister $userRegisterRequest
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function storeUser(UserRegisterRequest $userRegisterRequest)
    {
        $user = new User();
        $user->name = $userRegisterRequest->name;
        $user->email = $userRegisterRequest->email;
        $user->password = $userRegisterRequest->password;

        if (!empty($userRegisterRequest->file('cover'))) {
            $user->cover = $userRegisterRequest->file('cover')->store('users');
        }

        if (!$user->save()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors('');
        }

        auth()->loginUsingId($user->id);

        return redirect()->route('dashboard.index');
    }

}
