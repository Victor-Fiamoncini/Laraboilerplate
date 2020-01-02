<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Return dashboard main view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showIndexPage()
    {
        return view('pages.index')->with([
            'status' => 'success',
            'message' => auth()->user()->name . ', you were successfully registered!'
        ]);
    }

    /**
     * Display a listing of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('pages.profile')->with('user', $user);
    }

    /**
     * Update the specified user in storage.
     *
     * @param \Illuminate\Http\Request  $request
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
    }

    /**
     * Remove the specified user from storage.
     *
     * @param \App\User
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
    }
}
