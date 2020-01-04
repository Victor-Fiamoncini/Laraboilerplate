<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CompanyRegister extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'social_name' => 'required|max:255',
            'alias_name' => 'required|max:255',
            'document_company' => 'required|min:14|max:18',
            'document_company_secondary' => 'required|min:9|max:12',
            'zipcode' => 'required|max:255',
            'street' => 'required|max:255',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'number' => 'max:255',
            'complement' => 'required|max:255',
            'neighborhood' => 'required|max:255',
        ];
    }
}
