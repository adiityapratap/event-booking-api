<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Repositories\EventRepository;

class EventController extends Controller
{
    /**
     * @var \App\Repositories\EventRepository
     */
    protected $eventRepository;

    /**
     * EventController constructor.
     *
     * @param \App\Repositories\EventRepository $eventRepository
     */
    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
        // we cann uncomment this line when implementing JWT authentication
        // $this->middleware('auth:api');
    }

    /**
     * Display a listing of events with optional filters.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
       
        $filters = request()->only(['country', 'event_date']);
        
      
        $events = $this->eventRepository->getAll($filters);

        
        return EventResource::collection($events);
    }

    /**
     * Store a newly created event in storage.
     *
     * @param \App\Http\Requests\StoreEventRequest $request
     * @return \App\Http\Resources\EventResource
     */
    public function store(StoreEventRequest $request)
    {
        
        $event = $this->eventRepository->create($request->validated());
        return new EventResource($event);
    }

    /**
     * Display the specified event.
     *
     * @param int $id
     * @return \App\Http\Resources\EventResource
     */
    public function show($id)
    {
        
        $event = $this->eventRepository->find($id);

       
        return new EventResource($event);
    }

    /**
     * Update the specified event in storage.
     *
     * @param \App\Http\Requests\UpdateEventRequest $request
     * @param int $id
     * @return \App\Http\Resources\EventResource
     */
    public function update(UpdateEventRequest $request, $id)
    {
        
        $event = $this->eventRepository->find($id);

       
        $event = $this->eventRepository->update($event, $request->validated());

       
        return new EventResource($event);
    }

    /**
     * Remove the specified event from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
       
        $event = $this->eventRepository->find($id);

       
        $this->eventRepository->delete($event);

        
        return response()->json(['message' => 'Event deleted successfully']);
    }
}
