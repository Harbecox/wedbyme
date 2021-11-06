<?php

namespace App\Http\Requests;

use App\Models\FilterGroup;
use Illuminate\Validation\Rule;

class FilterGroupStoreRequest extends ApiRequest
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
            "title" => "required",
            "position" => "numeric",
            "type" => ['required',Rule::in(FilterGroup::TYPES)],
            "cat"  => ['required',Rule::in(FilterGroup::CATS)]
        ];
    }
}
