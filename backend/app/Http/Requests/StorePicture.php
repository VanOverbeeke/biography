<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePicture extends FormRequest
{

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->failed(), 422));
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        $messages = [
            'string' => 'The :attribute must be of type string.',
            'max' => 'The :attribute must have a max length of :max.',
            'required' => 'The :attribute is required.',
            'url' => 'The :attribute must be of type url.',
            'unique' => 'The :attribute must be unique in this table.',
            'numeric' => 'The :attribute must be of type numeric with maximum two decimal points.',
            'exists' => 'The :attribute must have an existing value.',
        ];
        return $messages;
    }

    public function rules()
    {
        $rules = [
            'path' => 'string|required',
            'imageable_id' => 'required|numeric',
            'imageable_type' => 'required|string'
        ];
        return $rules;
    }
}
