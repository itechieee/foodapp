<?php

namespace App\Http\Requests\API\Auth;

use App\Http\Requests\API\Request;

class LoginUserRequest extends Request
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
        $rules = [
          'email' => 'required|email',
          'password' => 'required'
        ];

        return $rules;
    }

    /**
     * Get the validation message that apply to the error response.
     *
     * @return array
     */
    public function messages()
    {
        return [
          'email.required' => 'The Email field is required.|1012',
          'email.email' => 'The Email field is invalid.|1013',
          'password.required' => 'The password field is required.|1014'
        ];
    }
}
