<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class projectRequest extends FormRequest
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
            'projectName' => 'required|string|max:255',
            'priority' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Pending,In Progress,Completed',
            'amount' => 'required|numeric|min:0',
            'idC' => 'required|exists:client,idC',
            'responsable' => 'required|exists:employee,id_e',
            'description' => 'required|string|max:1000',
            'dateS' => 'required|date',
            'dateF' => 'required|date|after_or_equal:dateS',
        ];
    }
}
