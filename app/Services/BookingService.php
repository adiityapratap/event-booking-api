<?php

namespace App\Services;

use App\Models\Event;
use App\Repositories\BookingRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BookingService
{
    /**
     * @var \App\Repositories\BookingRepository
     */
    protected $bookingRepository;

    /**
     * BookingService constructor.
     *
     * @param \App\Repositories\BookingRepository $bookingRepository
     */
    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    /**
     * Handle the event booking logic.
     *
     * @param int $eventId
     * @param int $attendeeId
     * @return \App\Models\Booking
     * @throws \Illuminate\Validation\ValidationException
     */
    public function bookEvent(int $eventId, int $attendeeId)
    {
        
        $event = Event::findOrFail($eventId);
        
        if ($event->availableCapacity() <= 0) {
            throw ValidationException::withMessages([
                'event_id' => 'This event is fully booked.',
            ]);
        }
      
        if ($this->bookingRepository->findByEventAndAttendee($eventId, $attendeeId)) {
            throw ValidationException::withMessages([
                'attendee_id' => 'This attendee has already booked this event.',
            ]);
        }
        
        return DB::transaction(function () use ($eventId, $attendeeId) {
            return $this->bookingRepository->create([
                'event_id' => $eventId,
                'attendee_id' => $attendeeId,
            ]);
        });
    }
}
