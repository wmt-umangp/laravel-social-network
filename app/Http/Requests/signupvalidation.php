<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class signupvalidation extends FormRequest
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
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'cpassword' => 'required|same:password|min:6',
        ];
    }
    public function messages(){
            return [
                'name.required' => 'Please Enter Name',
                'email.required' => 'Please Enter Email',
                'email.email'=>'Please Enter Valid Email',
                'email.unique'=> 'Email Already Exists!!',
                'password.required' => 'Please Enter Password',
                'password.min'=>'Password must be 6 character long',
                'cpassword.required' => 'Please Enter Confirm Password',
                'cpassword.same'=>'Confirm Password must be same as Password',
                'cpassword.min'=>'Confirm Password must be 6 character long',
            ];
    }
}
