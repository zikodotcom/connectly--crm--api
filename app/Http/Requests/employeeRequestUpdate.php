<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class employeeRequestUpdate extends FormRequest
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
        $employeeId = $this->route('employee');
        return [
            'fullName' => 'required|string|max:255',
            'userName' => 'required|string|max:255',
            'email' => 'required|email|unique:employee,email,' . $employeeId . ',id_e|max:255',
            'phone' => 'required|regex:/^\d+$/',
            'country' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zipCode' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'salary' => 'required|regex:/^\d+(\.\d{1,2})?$/'
        ];
    }
}
