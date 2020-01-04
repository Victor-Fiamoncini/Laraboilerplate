<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
use App\Http\Requests\CompanyRegister as CompanyRegisterRequest;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Return dashboard companies view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCompaniesPage()
    {
        return view('pages.companies');
    }

    /**
     * Register a new company into database
     *
     * @param \App\Http\Requests\CompanyRegister $userRegisterRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CompanyRegisterRequest $companyRegisterRequest)
    {
        $company = new Company();
        $company->fill($companyRegisterRequest->all());
        $company->user = Auth::user()->id;
        $company->save();

        return redirect()->route('dashboard.companies')->with([
            'status' => 'success',
            'message' => Auth::user()->name . ', your company was successfully registered!'
        ]);
    }

}
