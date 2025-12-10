<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Registration;
use App\Models\Event;

class RegistrationController extends Controller
{
    /**
     * Store a newly created registration.
     */
    public function store(Request $request, Event $event)
    {
        // Check if already registered
        $existingRegistration = Registration::where('event_id', $event->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingRegistration) {
            return back()->with('error', 'You are already registered for this event!');
        }

        // Check if event is full
        $currentParticipants = Registration::where('event_id', $event->id)
            ->where('status', 'confirmed')
            ->count();

        if ($currentParticipants >= $event->max_participants) {
            return back()->with('error', 'Sorry, this event is full!');
        }

        Registration::create([
            'event_id' => $event->id,
            'user_id' => Auth::id(),
            'status' => 'confirmed',
            'registration_date' => now(),
        ]);

        return back()->with('success', 'Successfully registered for the event!');
    }

    /**
     * Cancel a registration.
     */
    public function destroy(Event $event)
    {
        $registration = Registration::where('event_id', $event->id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$registration) {
            return back()->with('error', 'Registration not found!');
        }

        $registration->delete();

        return back()->with('success', 'Registration cancelled successfully!');
    }

    /**
     * View my registrations.
     */
    public function myRegistrations()
    {
        $registrations = Registration::with('event')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('registrations.my-registrations', compact('registrations'));
    }
}
