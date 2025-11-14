<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventWinner;
use App\Models\User;
use Illuminate\Http\Request;

class EventWinnerController extends Controller
{
    public function create($eventId)
    {
        $event = Event::with('winners.user')->findOrFail($eventId);
        
        if ($event->event_date > now()) {
            return redirect()->back()->with('error', 'Results can only be announced after the event ends.');
        }

        // Get all registered users for this event
        $participants = $event->registrations()
            ->where('status', 'attended')
            ->with('user')
            ->get()
            ->pluck('user');

        return view('events.winners-create', compact('event', 'participants'));
    }

    public function store(Request $request, $eventId)
    {
        $request->validate([
            'winners.*.user_id' => 'required|exists:users,id',
            'winners.*.position' => 'required|integer|min:1',
            'winners.*.prize' => 'nullable|string|max:255',
            'winners.*.description' => 'nullable|string'
        ]);

        $event = Event::findOrFail($eventId);

        // Delete existing winners
        $event->winners()->delete();

        // Add new winners
        foreach ($request->winners as $winner) {
            EventWinner::create([
                'event_id' => $eventId,
                'user_id' => $winner['user_id'],
                'position' => $winner['position'],
                'prize' => $winner['prize'] ?? null,
                'description' => $winner['description'] ?? null
            ]);
        }

        return redirect()->route('events.winners.show', $eventId)->with('success', 'Results announced successfully!');
    }

    public function show($eventId)
    {
        $event = Event::with(['winners' => function($query) {
            $query->orderBy('position');
        }, 'winners.user'])->findOrFail($eventId);

        if ($event->winners->isEmpty()) {
            return redirect()->back()->with('error', 'No results announced yet for this event.');
        }

        return view('events.winners-show', compact('event'));
    }
}
