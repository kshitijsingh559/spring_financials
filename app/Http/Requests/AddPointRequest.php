<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class AddPointRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|integer',
            'points'  => 'required|integer|min:1|max:100',
            'operator' => 'required|string'
        ];
    }

    /**
     * Get the validation failed response that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status_code'   => 422,
            'success'       => false,
            'data'          => $validator->errors()
        ])->setStatusCode(422));
    }
}
