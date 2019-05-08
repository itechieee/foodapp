<?php

namespace App\Http\Requests\API\Restaurant;

use App\Http\Requests\API\Request;

class RestaurantDetailRequest extends Request
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
          'restaurant_id' => 'required|numeric',
          'user_id' => 'required|numeric'
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
          'restaurant_id.required' => 'The restaurant id field is required.|1025',
          'restaurant_id.numeric' => 'The restaurant id field should be numeric.|1026',
          'user_id.required' => 'The user id field is required.|1027',
          'user_id.numeric' => 'The user id field should be numeric.|1028'
        ];
    }
}
