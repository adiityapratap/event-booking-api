<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Attendee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_book_event()
    {
        // Create an event with a specific capacity
        $event = Event::factory()->create(['capacity' => 10]);
        // Create an attendee
        $attendee = Attendee::factory()->create();

        // Make a POST request to book the event for the attendee
        $response = $this->postJson('/api/bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);

        // Assert the booking was created successfully
        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'event' => ['id', 'title', 'event_date', 'country'],
                    'attendee' => ['id', 'first_name', 'last_name', 'email'],
                ]
            ]);
    }

    public function test_prevents_duplicate_bookings()
    {
        // Create an event and an attendee
        $event = Event::factory()->create(['capacity' => 10]);
        $attendee = Attendee::factory()->create();

        // First booking request
        $this->postJson('/api/bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);

        // Second booking request should fail due to duplicate attendee
        $response = $this->postJson('/api/bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);

        // Assert that the second booking attempt returns a validation error
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['attendee_id' => 'This attendee has already booked this event.']);
    }

    public function test_prevents_overbooking()
    {
        // Create an event with only 1 available seat
        $event = Event::factory()->create(['capacity' => 1]);
        
        // Create two attendees
        $attendee1 = Attendee::factory()->create();
        $attendee2 = Attendee::factory()->create();

        // First booking request should succeed
        $this->postJson('/api/bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee1->id,
        ]);

        // Second booking request should fail due to overbooking
        $response = $this->postJson('/api/bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee2->id,
        ]);

        // Assert that the second booking attempt returns a validation error
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['event_id' => 'This event is fully booked.']);
    }

    public function test_bookings_return_event_and_attendee_info()
    {
        // Create event and attendee for testing
        $event = Event::factory()->create();
        $attendee = Attendee::factory()->create();

        // Book the event
        $response = $this->postJson('/api/bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);

        // Validate the response structure to check if event and attendee data are returned
        $response->assertStatus(201)
            ->assertJsonFragment([
                'event' => [
                    'id' => $event->id,
                    'title' => $event->title,
                ],
                'attendee' => [
                    'id' => $attendee->id,
                    'first_name' => $attendee->first_name,
                ],
            ]);
    }
}
