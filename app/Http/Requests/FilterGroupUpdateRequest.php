<?php

namespace App\Http\Requests;

use App\Models\FilterGroup;
use Illuminate\Validation\Rule;

class FilterGroupUpdateRequest extends ApiRequest
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
            "position" => "numeric",
            "type" => [Rule::in(FilterGroup::TYPES)],
        ];
    }
}
