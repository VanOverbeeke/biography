<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Redirect;

class StorePicture extends FormRequest
{

    protected function getValidatorInstance()
    {
        $data = $this->all();
        $requestValues = explode('|', $data['imageable']);
        $requestParams = [
            'path' => $data['path'],
            'imageable_type' => $requestValues[0],
            'imageable_id' => $requestValues[1]
        ];
//        dd($requestParams);
        $this->getInputSource()->replace($requestParams);
        return parent::getValidatorInstance();
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(array_values($validator->getMessageBag()->getMessages()), 422));
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'string' => 'The :attribute must be of type string.',
            'url' => 'The :attribute must be of type string and represent a valid URL.',
            'required' => 'The :attribute is required.',
            'numeric' => 'The :attribute must be of type numeric with maximum two decimal points.',
            'exists' => 'The :attribute must have an existing value.',
        ];
    }

    public function rules()
    {
        return [
            'path' => 'url|required',
            'imageable_id' => 'required|numeric',
            'imageable_type' => 'required|string'
        ];
    }
}
