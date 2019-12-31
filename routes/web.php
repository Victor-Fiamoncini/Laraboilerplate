<?php

use Illuminate\Support\Facades\Route;

/**
 * "/"
 */
Route::get('/', 'AuthController@showLoginPage')->name('login');

/**
 * "/login"
 */
Route::post('/login', 'AuthController@login')->name('login.do');

/**
 * "/logout"
 */
Route::get('/logout', 'AuthController@logout')->name('logout');

/**
 * "/register"
 */
Route::get('/register', 'AuthController@showRegisterPage')->name('register');

/**
 * "/register/user"
 */
Route::post('/register/user', 'AuthController@storeUser')->name('register.user');

/**
 * Reset password routes
 */
Route::prefix('password')->group(function () {
    /**
     * "/password"
     */
    Route::get('/', 'AuthController@showForgotPasswordPage')->name('password');

    /**
     * "/password/reset/mail"
     */
    Route::post('/reset/mail', 'AuthController@sendResetPasswordMail')->name('password.mail');

    /**
     * "password/reset/{token}"
     */
    Route::get('/reset/{token}', 'AuthController@showResetPasswordForm')->name('password.form');

    /**
     * "password/reset"
     */
    Route::post('/reset', 'AuthController@reset')->name('password.reset.do');
});

/**
 * Auth providers redirect
 *
 * "/auth/{provider}
 */
Route::get('/auth/{provider}', 'AuthController@redirectToProvider')->name('auth.provider');

/**
 * Auth providers callback
 *
 * "/{provider}/auth/callback"
 */
Route::get('/{provider}/auth/callback', 'AuthController@handleProviderCallback')->name('provider.callback');

/**
 * Protected dashboard routes
 *
 * "/dashboard"
 */
Route::group(['prefix' => 'dashboard', 'middleware' => ['auth'], 'as' => 'dashboard.'], function () {
    /**
     * "/dashboard"
     */
    Route::get('/', 'UserController@showIndexPage')->name('index');

    /**
     * "/dashboard/user/{user}/edit"
     */
    Route::get('/user/{user}/edit', 'UserController@edit')->name('user.edit');

    /**
     * "/dashboard/user/update"
     */
    Route::put('/user/{user}', 'UserController@update')->name('user.update');
});

