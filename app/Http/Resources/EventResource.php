<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'event_date' => $this->event_date->toIso8601String(), 
            'country' => $this->country,
            'capacity' => $this->capacity,
            'available_capacity' => $this->availableCapacity(),  
            'created_at' => $this->created_at->toIso8601String(),  
        ];
    }
}
