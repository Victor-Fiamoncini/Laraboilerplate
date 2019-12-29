<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Return login view
     */
    public function showLoginPage()
    {
        return view('admin.pages.login');
    }

    /**
     * Return register user view
     */
    public function showRegisterPage()
    {
        return view('admin.pages.users.register');
    }

    /**
     * Register a new user into database
     */
    public function storeUser(Request $request)
    {
        dd($request->all());
    }

}
