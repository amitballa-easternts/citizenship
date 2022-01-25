<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CitizenRequest extends FormRequest
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
        return  [
            'first_name' => 'required|max:50',
            'lastname' => 'required|max:50',
            //'state' => 'required|max:50',
            'aadhar_card' => 'required', 'integer', 'digits:12', 'regex:/^[2-9]{1}[0-9]{3}[0-9]{4}[0-9]{4}$/i',
            'mobile_number' => 'required|integer|digits:10|starts_with:9,8,7,6',
            //'email' => 'required|max:255|unique:Citizens,email,NULL,id',
            'password' => 'required|max:50',
        ];
    }
}
