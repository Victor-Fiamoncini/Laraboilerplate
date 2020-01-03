<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function showCompaniesPage()
    {
        return view('pages.companies')->with('user', Auth::user());
    }

    public function store()
    {
        # code...
    }

}
