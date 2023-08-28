<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class JobPostRequest extends FormRequest
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
            'position' => 'required|',
            'level' => 'required|array',
            'skill' => 'required|array',
            'type' => 'required|array',
            'content' => 'required|string',
            'requirement' => 'required',
            'quantity' => 'required|integer',
            'benefits' => 'required|string',
            'start_day' => 'required|date',
            'end_day' => 'required|date'
        ];
    }

    /**
     * Determine message.
     *
     * @return array
     */
    public function messages()
    {
        return [];
    }

    public function failedValidation(Validator $validator)
    {
    }

    public function getValidator()
    {
        return $this->getValidatorInstance();
    }
}
