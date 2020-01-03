<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserUpdate extends FormRequest
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
            'name' => 'min:3|max:255',
            'email' => !empty($this->request->all()['id'])
                ? 'email|unique:users,email,' . $this->request->all()['id']
                : 'email|unique:users,email',
            'password' => 'same:password_confirmation',
            'password_confirmation' => '',
        ];
    }
}
