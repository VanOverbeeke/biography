<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGenus extends FormRequest
{
    /**
     *Return validation failed message
     *
     */
    protected function failedValidation(Validator $validator)
    {

        throw new HttpResponseException(response()->json(array_values($validator->getMessageBag()->getMessages()), 422));
    }

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
            'name' => 'string|required|unique:genus|max:50'
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'This genus already exists!',
            'name.max' => 'Genus name should be shorter than 50 characters.'
        ];
    }
}
