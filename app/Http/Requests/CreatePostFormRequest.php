<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostFormRequest extends FormRequest
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
            'body'=>'required|max:1000'
        ];
    }
    public function messages()
    {
        return [
            'body.required'=>'Please Enter Text in Field!!',
            'body.max'=>'maximum 1000 character allowed!!',
        ];
    }
}
