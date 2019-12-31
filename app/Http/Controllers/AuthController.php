<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRegister as UserRegisterRequest;
use App\Http\Requests\UserLogin as UserLoginRequest;
use App\Support\Resizer;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as SocialiteUser;
use Exception;

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

        if (!$newUser->save()) {
            return redirect()->back()->withInput()->withErrors('');
        }

        auth()->loginUsingId($newUser->id);

        return redirect()->route('dashboard.index')->with([
            'status' => 'success',
            'message' => $newUser->name . ', you were successfully registered!'
        ]);
    }

    /**
     * Make user authentication
     *
     * @param App\Http\Requests\UserLogin $userLoginRequest
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function login(UserLoginRequest $userLoginRequest)
    {
        if (!auth()->attempt($userLoginRequest->only(['email', 'password']))) {
            return redirect()->back()->withInput()->withErrors([
                'credentials' => 'Invalid credentials entered, please try again',
            ]);
        }

        $this->updateLoginInfos($userLoginRequest->getClientIp());

        return redirect()->route('dashboard.index')->with([
            'status' => 'success',
            'message' => 'Welcome ' . auth()->user()->name . '!'
        ]);
    }

    /**
     * Logout user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }

    /**
     * Redirect the user to the provider authentication page
     *
     * @param string $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToProvider(string $provider)
    {
        try {
            return Socialite::driver($provider)->redirect();
        } catch (Exception $e) {
            return redirect()->route('login')->with([
                'status' => 'danger',
                'message' => 'Something went wrong while authenticating, please try again'
            ]);
        }
    }

    /**
     * Obtain the user information from provider
     *
     * @param string $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback(string $provider)
    {
        try {
            $callbackUser = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect()->route('login')->with([
                'status' => 'danger',
                'message' => 'Something went wrong while authenticating, please try again'
            ]);
        }

        $authUser = $this->findOrCreateGithubUser($callbackUser, $provider);

        if (!empty($authUser)) {
            auth()->loginUsingId($authUser->id);
            return redirect()->route('dashboard.index');
        }

        return redirect()->route('login')->with([
            'status' => 'danger',
            'message' => 'Something went wrong while authenticating, please try again'
        ]);
    }

    /**
     * Return user if exists, or create and return if doesn't
     *
     * @param string $provider
     * @param \Laravel\Socialite\Two\User $callbackUser
     * @return \App\User|null
     */
    private function findOrCreateGithubUser(SocialiteUser $callbackUser, string $provider): ?User
    {
        if ($authUser = User::where('email', $callbackUser->email)->first()) {
            return $authUser;
        }

        if (!empty($callbackUser->name)) {
            $rawPassword = uniqid();

            $newUser = User::create([
                'name' => $callbackUser->name,
                'email' => $callbackUser->email,
                'password' => bcrypt($rawPassword),
                $provider . '_id' => $callbackUser->id,
                'cover' => $callbackUser->avatar,
            ]);

            // Store the avatar photo and create thumb

            session()->flash('providerFirstLogin', true);

            // Send email with current password and link to change it

            return $newUser;
        }

        return null;
    }

    /**
     * Update user login infos (date & ip)
     *
     * @param string $ip
     * @return void
     */
    private function updateLoginInfos(string $ip): void
    {
        $user = User::where('id', auth()->user()->id);
        $user->update([
            'last_login_at' => date('Y-m-d H:i:s'),
            'last_login_ip' => $ip,
        ]);
    }

}
