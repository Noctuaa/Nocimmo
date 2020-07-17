<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterEstateRequest extends FormRequest
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
            'bedroom' => 'min:0|nullable',
            'bathroom' => 'min:0|nullable',
            'area' => 'min:0|nullable',
            'min_price' => 'min:0|nullable',
            'max_price' => 'gte:min_price|not_in:0|nullable',
        ];
    }
}
