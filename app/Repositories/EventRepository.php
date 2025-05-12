<?php

namespace App\Repositories;

use App\Models\Event;

class EventRepository
{
    /**
     * Get all events with optional filters and pagination.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAll(array $filters = [], int $perPage = 10)
    {
        $query = Event::query();

        // Apply country filter if provided
        if (isset($filters['country'])) {
            $query->where('country', $filters['country']);
        }

        // Apply event_date filter if provided
        if (isset($filters['event_date'])) {
            $query->whereDate('event_date', $filters['event_date']);
        }

        // Return the paginated result
        return $query->paginate($perPage);
    }

    /**
     * Find an event by its ID.
     *
     * @param int $id
     * @return \App\Models\Event
     */
    public function find(int $id)
    {
        return Event::findOrFail($id);
    }

    /**
     * Create a new event.
     *
     * @param array $data
     * @return \App\Models\Event
     */
    public function create(array $data)
    {
        return Event::create($data);
    }

    /**
     * Update an existing event.
     *
     * @param \App\Models\Event $event
     * @param array $data
     * @return \App\Models\Event
     */
    public function update(Event $event, array $data)
    {
        $event->update($data);
        return $event;
    }

    /**
     * Delete an event.
     *
     * @param \App\Models\Event $event
     * @return void
     */
    public function delete(Event $event)
    {
        $event->delete();
    }
}
