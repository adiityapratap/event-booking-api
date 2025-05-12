<?php

use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\AttendeeController;
use App\Http\Controllers\Api\BookingController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    // Event Routes (Authenticated)
    Route::apiResource('events', EventController::class)
        ->middleware('auth:api');  // Add authentication middleware here

    // Attendee Routes (Unauthenticated)
    Route::post('attendees', [AttendeeController::class, 'store']);
    Route::get('attendees/{id}', [AttendeeController::class, 'show']);

    // Booking Routes (Unauthenticated)
    Route::post('bookings', [BookingController::class, 'store']);
    Route::get('bookings/{id}', [BookingController::class, 'show']);
});
