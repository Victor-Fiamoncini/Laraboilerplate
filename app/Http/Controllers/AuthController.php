<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRegister as UserRegisterRequest;
use App\Support\Resizer;

class AuthController extends Controller
{
    /**
     * Return login view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginPage()
    {
        if (auth()->check()) {
            return redirect()->route('dashboard.index');
        }
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
        $newUser = new User();
        $newUser->name = $userRegisterRequest->name;
        $newUser->email = $userRegisterRequest->email;
        $newUser->password = $userRegisterRequest->password;

        if (!empty($userRegisterRequest->file('cover'))) {
            $resizer = new Resizer($userRegisterRequest->file('cover'), 'users');
            $newUser->cover = $resizer->storeOriginalImage();
            $newUser->cover_thumb = $resizer->makeThumb();
        }

        dd($newUser);

        if (!$newUser->save()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors('');
        }

        auth()->loginUsingId($newUser->id);

        return redirect()
            ->route('dashboard.index')
            ->with([
                'status' => 'success',
                'message' => $newUser->name . ', you were successfully registered!'
            ]);
    }

}
