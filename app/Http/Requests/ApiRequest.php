<?php


namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ApiRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $ex = new ValidationException($validator);
        $errors = $ex->errors();
        $message = $ex->getMessage();

        throw new HttpResponseException(
            response()->json(["message" => $message,"errors" => $errors],JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
