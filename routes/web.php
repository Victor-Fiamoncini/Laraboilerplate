<?php

use Illuminate\Support\Facades\Route;

/**
 * "/"
 */
Route::get('/', 'AuthController@showLoginPage')->name('login');

/**
 * "/register"
 */
Route::get('/register', 'AuthController@showRegisterPage')->name('register');

/**
 * "/register/user"
 */
Route::post('/register/user', 'AuthController@storeUser')->name('register.user');

/**
 * Private routes
 */
Route::group(['prefix' => 'dashboard', 'middleware' => ['auth'], 'as' => 'admin.'], function () {
    /**
     * "/dashboard"
     */
    Route::get('/dashboard', 'UserController@index');
});

