<?php

namespace App\Http\Requests\API\Auth;

use App\Http\Requests\API\Request;

class UserRegisterRequest extends Request
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
          'firstname' => 'required',
          'middlename' => 'required',
          'lastname' => 'required',
          'email' => 'required|email',
          'password' => 'required',
          'confirm_password' => 'required|same:password',
          'phone' => 'required|numeric',
          'role' => 'required|numeric'
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
          'firstname.required' => 'The Firstname field is required.|1009',
          'middlename.required' => 'The Middlename field is required.|1010',
          'lastname.required' => 'The Lastname field is required.|1011',
          'email.required' => 'The Email field is required.|1012',
          'email.email' => 'The Email field is invalid.|1013',
          'password.required' => 'The password field is required.|1014',
          'confirm_password.required' => 'The Confirm Password field is required.|1015',
          'confirm_password.same' => 'The Confirm Password field not matched with password field.|1016',
          'role.required' => 'The Role field is required.|1017',
          'role.numeric' => 'The Role field is invalid.|1018',
          'phone.required' => 'The Phone field is required|1021',
          'phone.numeric' => 'The Phone field is invalid|1022'
        ];
    }
}
