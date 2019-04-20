<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

abstract class Request extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $statusCode = 422;
        $errors = $this->formatError($validator->errors()->all());        
        if ($this->ajax() || $this->wantsJson()) {
            $errorFormat = $this->failureResponse($errors, 'Validation Errors', $statusCode);
            throw new HttpResponseException($errorFormat);
        }
    }

    private function formatError($errors)
    {
        $result = [];
        $i=0;
        foreach ($errors as $key => $values) {
            $message = explode('|', $values);
            $result[$i] = appmsgError($message[1], $message[0]);
            $i++;
        }
        return $result;
    }   

    private function failureResponse($data = array(), $message = 'Failure', $code = null)
    {
        $response = [
            'error'     => $data,
            'status'    => false,
            'message'   => $message ? $message : 'Failure',
            'status_code'      => $code 
        ];
        
        return response()->json(
            (object)$response,
            $code
        );
    }

}