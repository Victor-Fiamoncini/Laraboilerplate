<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
use App\Http\Requests\CompanyRegister as CompanyRegisterRequest;
use App\Http\Requests\CompanyUpdate as CompanyUpdateRequest;
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
        $companies = User::find(Auth::user()->id)->companies;
        return view('pages.companies')->with('companies', $companies);
    }

    /**
     * Register a new company into database
     *
     * @param \App\Http\Requests\CompanyRegister $companyRegisterRequest
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

    /**
     * Show company update form
     *
     * @param int $companyId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCompanyEditPage(int $companyId)
    {
        $company = User::find(Auth::user()->id)
            ->companies()
            ->where('id', $companyId)
            ->first();

        return view('pages.companies-edit')->with('company', $company);
    }

    /**
     * Update a company
     *
     * @param \App\Http\Requests\CompanyUpdate $companyUpdateRequest
     * @param int $companyId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CompanyUpdateRequest $companyUpdateRequest, int $companyId)
    {
        $company = User::find(Auth::user()->id)
            ->companies()
            ->where('id', $companyId)
            ->first();

        $company->fill($companyUpdateRequest->all());
        $company->save();

        return redirect()->route('dashboard.companies')->with([
            'status' => 'success',
            'message' => Auth::user()->name . ', your company ' . $company->social_name . ' was successfully updated!'
        ]);
    }

}
