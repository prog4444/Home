<?php

namespace App\Http\Requests\Apartiment;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'city_id' => 'required|exists:cities,id',
            'terms_id' => 'required|exists:terms,id',
            'how_many_rooms' => 'integer|nullable',
            'description' => 'string|nullable',
            'price' => 'nullable',
            'is_free' => 'required|boolean',
            'address' => 'nullable|string'
        ];
    }
}
