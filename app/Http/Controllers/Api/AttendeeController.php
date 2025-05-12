<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendeeResource;
use App\Http\Requests\StoreAttendeeRequest;
use App\Models\Attendee;

class AttendeeController extends Controller
{
    /**
     * Store a newly created attendee in storage.
     *
     * @param \App\Http\Requests\StoreAttendeeRequest $request
     * @return \App\Http\Resources\AttendeeResource
     */
    public function store(StoreAttendeeRequest $request)
    {
        // Create a new attendee using validated data from the request
        $attendee = Attendee::create($request->validated());

        // Return the created attendee as a resource
        return new AttendeeResource($attendee);
    }

    /**
     * Display the specified attendee.
     *
     * @param int $id
     * @return \App\Http\Resources\AttendeeResource
     */
    public function show($id)
    {
        // Find the attendee by id, or fail with a 404 if not found
        $attendee = Attendee::findOrFail($id);

        // Return the attendee as a resource
        return new AttendeeResource($attendee);
    }
}
