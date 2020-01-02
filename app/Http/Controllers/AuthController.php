<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRegister as UserRegisterRequest;
use App\Http\Requests\UserLogin as UserLoginRequest;
use App\Http\Requests\UserResetPassword as UserResetPasswordRequest;
use App\Mail\NewPassword as NewPasswordMail;
use App\Mail\ResetPassword as ResetPasswordMail;
use App\Support\Resizer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as SocialiteUser;
use Exception;
use Illuminate\Support\Facades\Hash;

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

        $authUser = $this->findOrCreateCallbackUser($callbackUser, $provider);

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
    private function findOrCreateCallbackUser(SocialiteUser $callbackUser, string $provider): ?User
    {
        if ($authUser = User::whereEmail($callbackUser->email)->first()) {
            return $authUser;
        }

        if (!empty($callbackUser->name)) {
            $rawPassword = Str::random(16);

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
     * Return forgot password view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showForgotPasswordPage()
    {
        return view('pages.forgot-password');
    }

    /**
     * Send a email with reset password access token
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetPasswordMail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255|exists:users,email'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $user = User::whereEmail($request->email)->first();
        $token = Str::random(16);

        DB::table('password_resets')->insert([
            'email' => $user->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::to($request->email)->send(new ResetPasswordMail($user, $token));

        // return view('mail.reset-password')->with([
        //     'user' => $user,
        //     'token' => $token
        // ]);

        return redirect()->route('login')->with([
            'status' => 'success',
            'message' => $user->name . ', an email has been sent to you with the access token to modify your password.'
        ]);
    }

    /**
     * Return reset password view
     *
     * @param string $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetPasswordForm(string $token)
    {
        return view('pages.reset-password')->with('token', $token);
    }

    /**
     * Change user password and send email with it
     *
     * @param \App\Http\Requests\UserResetPassword
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetPassword(UserResetPasswordRequest $userResetPasswordRequest)
    {
        $token = DB::table('password_resets')->where('token', $userResetPasswordRequest->token)->first();

        if (empty($token)) {
            return redirect()->route('login')->with([
                'status' => 'danger',
                'message' => 'Your access token are not valid to change your password.'
            ]);
        }

        $user = User::whereEmail($userResetPasswordRequest->email)->first();
        $user->password = Hash::make($userResetPasswordRequest->password);
        $user->save();

        DB::table('password_resets')->whereEmail($user->email)->delete();

        Mail::to($user->email)->send(new NewPasswordMail($user, $userResetPasswordRequest->password));

        return redirect()->route('login')->with([
            'status' => 'success',
            'message' => $user->name . ', your password was successfully modified!'
        ]);
    }

    /**
     * Update the first random user password
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
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
