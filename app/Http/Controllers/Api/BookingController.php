<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookingResource;
use App\Http\Requests\StoreBookingRequest;
use App\Services\BookingService;

class BookingController extends Controller
{
    protected $bookingService;

    /**
     * BookingController constructor.
     * 
     * @param \App\Services\BookingService $bookingService
     */
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * Store a newly created booking in storage.
     *
     * @param \App\Http\Requests\StoreBookingRequest $request
     * @return \App\Http\Resources\BookingResource
     */
    public function store(StoreBookingRequest $request)
    {
       
        $booking = $this->bookingService->bookEvent(
            $request->input('event_id'),
            $request->input('attendee_id')
        );

       
        return new BookingResource($booking);
    }

    /**
     * Display the specified booking.
     *
     * @param int $id
     * @return \App\Http\Resources\BookingResource
     */
    public function show($id)
    {
      
        $booking = $this->bookingService->find($id);

        return new BookingResource($booking);
    }
}
