<?php

namespace App\Http\Controllers;

use App\User;
use App\Support\Resizer;
use App\Http\Requests\UserRegister as UserRegisterRequest;
use App\Http\Requests\UserUpdate as UserUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Register a new user into database
     *
     * @param App\Http\Requests\UserRegister $userRegisterRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRegisterRequest $userRegisterRequest)
    {
        $newUser = new User();
        $newUser->name = $userRegisterRequest->name;
        $newUser->email = $userRegisterRequest->email;
        $newUser->password = $userRegisterRequest->password;

        if (!empty($userRegisterRequest->file('cover'))) {
            $resizer = new Resizer('users', $userRegisterRequest->file('cover'));
            $newUser->cover = $resizer->makeThumb();
        }

        if (!$newUser->save()) {
            return redirect()->back()->withInput()->withErrors('');
        }

        Auth::loginUsingId($newUser->id);

        return redirect()->route('dashboard.profile')->with([
            'status' => 'success',
            'message' => $newUser->name . ', you were successfully registered!'
        ]);
    }

    /**
     * Return dashboard profile view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showProfilePage()
    {
        return view('pages.profile');
    }

    /**
     * Update the specified user in storage
     *
     * @param App\Http\Requests\UserUpdate $userUpdateRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $userUpdateRequest)
    {
        $user = User::where('id', Auth::user()->id)->first();

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
     * Update user photo
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePhoto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cover' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $user = User::where('id', Auth::user()->id)->first();

        Storage::delete($user->cover);

        $resizer = new Resizer('users', $request->file('cover'));
        $user->cover = $resizer->makeThumb();
        $user->save();

        return redirect()->route('dashboard.profile')->with([
            'status' => 'success',
            'message' => 'Profile photo updated successfully!'
        ]);
    }

}
