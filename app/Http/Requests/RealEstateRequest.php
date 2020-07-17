<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class RealEstateRequest extends FormRequest
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
            'name' => 'required|min:2',
            'description' => 'required|min:3',
            "category" => "required|in:sales,rentals",
            "address" => "required|max:150",
            "area" => "required|integer|min:0",
            "price" => "required|integer|min:0",
            "bedroom" => "required|min:0",
            "bathroom" => "required|min:0",
            "wc" => "required|min:0",
        ];

        $images = Storage::disk('public')->allFiles('/images/realEstates/'. $this->id . '/Large');

        $thumbnail = Storage::disk('public')->exists('/images/realEstates/' . $this->id  . '/Thumbnail/thumbnail_' . $this->id .'.jpg');
        
        if($this->id === null || !$images ){
            $rules += ['images' => 'required'];
        }
        
        if($this->id === null || !$thumbnail){
            $rules += ['thumbnail' => 'required'];
        }

        return $rules;
    }
}
