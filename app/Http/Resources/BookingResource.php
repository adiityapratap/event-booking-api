<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'event' => new EventResource($this->event),  
            'attendee' => new AttendeeResource($this->attendee),  
            'created_at' => $this->created_at->toIso8601String(),  
        ];
    }
}
