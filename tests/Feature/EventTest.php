<?php

namespace Tests\Feature;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_event()
    {
        // Prepare data for event creation
        $eventData = [
            'title' => 'Tech Conference',
            'description' => 'A tech conference',
            'event_date' => now()->addDay()->toDateTimeString(),
            'country' => 'USA',
            'capacity' => 100,
        ];

        // Send a POST request to create a new event
        $response = $this->postJson('/api/events', $eventData);

        // Assert the event is created successfully
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data' => [
                         'id',
                         'title',
                         'event_date',
                         'country',
                         'capacity',
                         'description',  // Ensure description is part of the response
                     ]
                 ]);
    }

    public function test_can_list_events_with_pagination()
    {
        // Create 15 events using a factory
        Event::factory()->count(15)->create();

        // Send a GET request to fetch events
        $response = $this->getJson('/api/events');

        // Assert the events are returned with pagination
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => [
                         '*' => [  // Ensures pagination data is returned for each event
                             'id',
                             'title',
                             'event_date',
                             'country',
                         ]
                     ],
                     'links',  // Ensure pagination links are present
                     'meta',   // Ensure pagination metadata is present
                 ]);
    }
}
