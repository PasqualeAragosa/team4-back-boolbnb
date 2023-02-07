<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePropertyRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', Rule::unique('properties')->ignore($this->property), 'min:5', 'max:100'],
            'price' => 'nullable|numeric',
            'rooms_num' => 'nullable|numeric',
            'beds_num' => 'nullable|numeric',
            'baths_num' => 'nullable|numeric',
            'square_meters' => 'nullable|numeric',
            'address' => 'nullable|min:2|max:60',
            'image' => 'nullable|image|max:300',
            'visibility' => 'boolean',
            'description' => 'nullable',
        ];
    }
}
