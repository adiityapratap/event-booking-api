<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * 
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // No authentication required for booking
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
            'event_id' => 'required|exists:events,id',  
            'attendee_id' => 'required|exists:attendees,id',  
        ];
    }

    /**
     * Custom messages for validation.
     * 
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'event_id.required' => 'The event ID is required.',
            'event_id.exists' => 'The selected event does not exist.',
            'attendee_id.required' => 'The attendee ID is required.',
            'attendee_id.exists' => 'The selected attendee does not exist.',
        ];
    }
}
