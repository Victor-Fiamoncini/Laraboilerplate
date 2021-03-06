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
Route::post('/register/user', 'UserController@store')->name('register.user');

/**
 * Reset password routes
 */
Route::prefix('password')->group(function() {
    /**
     * "/password/forgot"
     */
    Route::get('/forgot', 'AuthController@showForgotPasswordPage')->name('password.forgot');

    /**
     * "/password/reset/mail"
     */
    Route::post('/reset/mail', 'AuthController@sendResetPasswordMail')->name('password.reset.mail');

    /**
     * "password/reset/{token}"
     */
    Route::get('/reset/{token}', 'AuthController@showResetPasswordForm')->name('password.reset.form');

    /**
     * "password/reset"
     */
    Route::put('/reset', 'AuthController@resetPassword')->name('password.reset.do');
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
Route::group(['prefix' => 'dashboard', 'middleware' => ['auth'], 'as' => 'dashboard.'], function() {
    /**
     * "/dashboard"
     */
    Route::get('/', 'UserController@showProfilePage')->name('profile');

    /**
     * "/dashboard/user/update"
     */
    Route::put('/user/update', 'UserController@update')->name('user.update');

    /**
     * "/dashboard/user/update/photo"
     */
    Route::put('/user/update/photo', 'UserController@updatePhoto')->name('user.update.photo');

    /**
     * "/dashboard/companies"
     */
    Route::get('/companies', 'CompanyController@showCompaniesPage')->name('companies');

    /**
     * "/dashboard/companies/store"
     */
    Route::post('/companies/store', 'CompanyController@store')->name('companies.store');

    /**
     * "/dashboard/companies/{company}/edit"
     */
    Route::get('/companies/{company}/edit', 'CompanyController@showCompanyEditPage')->name('companies.edit');

    /**
     * "/dashboard/companies/{company}/update"
     */
    Route::put('/companies/{company}/update', 'CompanyController@update')->name('companies.update');

    /**
     * "/dashboard/employees"
     */
    Route::resource('employees', 'EmployeeController');
});

