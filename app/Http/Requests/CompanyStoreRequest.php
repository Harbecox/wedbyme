<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyStoreRequest extends ApiRequest
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
            "phone" => "required|regex:/^([+]?[0-9]{11,13})*$/",
            "email" => "required|email|unique:users",
            "password" => "required|min:8",
            "title" => "required",
            "role"  => Rule::in(User::ROLES),
        ];
    }
}
