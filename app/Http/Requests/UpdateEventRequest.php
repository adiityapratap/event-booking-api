<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Placeholder for user authorization logic.
        // For example, return auth()->check(); for simple authentication.
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
            'title' => 'sometimes|string|max:255',         
            'description' => 'sometimes|nullable|string', 
            'event_date' => 'sometimes|date|after:now',    
            'country' => 'sometimes|string|max:100',     
            'capacity' => 'sometimes|integer|min:1',      
        ];
    }

    /**
     * Custom messages for validation.
     
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'title.sometimes' => 'The event title is optional but must be a string if provided.',
            'event_date.after' => 'The event date must be in the future if provided.',
            'country.sometimes' => 'The country is optional but must be a valid string if provided.',
            'capacity.min' => 'Capacity must be at least 1.',
        ];
    }
}
