<?php

namespace App\Repositories;

use App\Models\Booking;

class BookingRepository
{
    /**
     * Find a booking by event ID and attendee ID.
     *
     * @param int $eventId
     * @param int $attendeeId
     * @return \App\Models\Booking|null
     */
    public function findByEventAndAttendee(int $eventId, int $attendeeId)
    {
        return Booking::where('event_id', $eventId)
            ->where('attendee_id', $attendeeId)
            ->first();
    }

    /**
     * Create a new booking.
     *
     * @param array $data
     * @return \App\Models\Booking
     */
    public function create(array $data)
    {
        return Booking::create($data);
    }

    /**
     * Find a booking by its ID.
     *
     * @param int $id
     * @return \App\Models\Booking
     */
    public function find(int $id)
    {
        return Booking::findOrFail($id);
    }
}
