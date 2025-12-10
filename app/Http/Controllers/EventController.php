<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the events.
     */
    public function index()
    {
        $events = Event::orderBy('event_date', 'desc')->paginate(10);
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'max_participants' => 'required|integer|min:1',
            'status' => 'required|in:active,completed,cancelled',
        ]);

        $validated['organizer_id'] = Auth::id();

        Event::create($validated);

        return redirect()->route('events.index')->with('success', 'Event created successfully!');
    }

    /**
     * Display the specified event.
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit(Event $event)
    {
        // Only organizer or admin can edit
        if (Auth::user()->role === 'student' && $event->organizer_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified event in storage.
     */
    public function update(Request $request, Event $event)
    {
        // Only organizer or admin can update
        if (Auth::user()->role === 'student' && $event->organizer_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'max_participants' => 'required|integer|min:1',
            'status' => 'required|in:active,completed,cancelled',
        ]);

        $event->update($validated);

        return redirect()->route('events.index')->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy(Event $event)
    {
        // Only organizer or admin can delete
        if (Auth::user()->role === 'student' && $event->organizer_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully!');
    }
}
