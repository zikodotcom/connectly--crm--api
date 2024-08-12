<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class clientRequestUpdate extends FormRequest
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'clientName' => 'required|string',
            'owner' => 'required|string',
            'industry' => 'required|string',
            'currency' => 'required|string',
            'languages' => 'required|string',
            'description' => 'required|string',
            'website' => 'required|url',
            'email' => 'required|email',
            'phone' => 'required|regex:/^\d+$/',
            'country' => 'required|string',
            'adresse' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipCode' => 'required|string',
            'facebook' => 'nullable|regex:/^(https?:\/\/)?(www\.)?facebook.com\/[A-Za-z0-9_.-]+\/?$/',
            'instgram' => 'nullable|regex:/^(https?:\/\/)?(www\.)?instagram.com\/[A-Za-z0-9_.-]+\/?$/',
            'linkedin' => 'nullable|regex:/^(https?:\/\/)?(www\.)?linkedin.com\/in\/[A-Za-z0-9_-]+\/?$/',
            'twitter' => 'nullable|regex:/^(https?:\/\/)?(www\.)?twitter.com\/[A-Za-z0-9_]+\/?$/',
            'whatsapp' => 'nullable|regex:/^\d+$/'
        ];
    }
}
