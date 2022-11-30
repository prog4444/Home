<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotoRequest extends FormRequest
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
            // 'text' => 'required|string',
            // 'drop' => 'required|string',
            'images' => 'nullable|image|max:5120|mimes:jpg,jpeg,png',
            // 'city_id' => 'required|exists:cities,id',
            // 'terms_id' => 'required|exists:terms,id',
            // 'how_many_rooms' => 'integer|nullable',
            // 'description' => 'string|nullable',
            // 'price' => 'nullable',
            // 'is_free' => 'required|boolean',
            // 'address' => 'nullable|string',
            // 'images' => 'nullable|image|max:5120|mimes:jpg,jpeg,png',
        ];
    }
}
