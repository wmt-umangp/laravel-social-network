<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class signinvalidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Please Enter Email',
            'email.email'=>'Please Enter Valid Email',
            'password.required' => 'Please Enter Password',
        ];
    }
}
