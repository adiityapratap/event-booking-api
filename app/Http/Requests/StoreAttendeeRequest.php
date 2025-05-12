<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttendeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * 
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // No authentication required for attendees
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:100', 
            'last_name' => 'required|string|max:100',  
            'email' => 'required|email|unique:attendees,email',  
        ];
    }

    /**
     * Custom messages for validation.
     * Customize these messages based on your needs.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'The first name is required.',
            'last_name.required' => 'The last name is required.',
            'email.required' => 'The email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'The email address has already been taken.',
        ];
    }
}
