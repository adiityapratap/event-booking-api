<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
    
     *
     * @return bool
     */
    public function authorize(): bool
    {
       
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
            'title' => 'required|string|max:255',       
            'description' => 'nullable|string',          
            'event_date' => 'required|date|after:now',    
            'country' => 'required|string|max:100',       
            'capacity' => 'required|integer|min:1',       
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
            'title.required' => 'The event title is required.',
            'event_date.after' => 'The event date must be in the future.',
            'country.required' => 'The country field is required.',
            'capacity.min' => 'Capacity must be at least 1.',
        ];
    }
}
