<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSpecies extends FormRequest
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
            'name' => 'string|required|unique:species|max:50',
            'genus_id' => 'required|exists:genus,id',
            'wiki' => 'nullable|url',
            'age' => 'nullable|numeric',
            'size' => 'nullable|numeric',
            'weight' => 'nullable|numeric'
        ];
    }
}
