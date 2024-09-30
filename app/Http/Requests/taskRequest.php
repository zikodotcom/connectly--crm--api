<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class taskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'taskName' => [
                'required',
                'min:3',
            ],
            'dateS' => [
                'required',
                'before_or_equal:dateF'
            ],
            'dateF' => [
                'required',
                'after_or_equal:dateS'
            ],
            'status' => 'required',
            'id' => 'required',
            'description' => [
                'required',
                'min:10',
            ],
        ];
    }
}
