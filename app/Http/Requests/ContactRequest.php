<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|max:255|regex:/(.*)@myemail\.com/i|unique:users',
            'textContact' => 'required',
            'subject' => 'required|min:10|max:255'
        ];
    }
}
