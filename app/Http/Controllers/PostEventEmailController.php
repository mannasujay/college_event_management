<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Mail\PostEventMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostEventEmailController extends Controller
{
    public function send($eventId)
    {
        $event = Event::with(['registrations' => function($query) {
            $query->where('status', 'attended');
        }, 'registrations.user', 'organizer'])->findOrFail($eventId);

        if ($event->event_date > now()) {
            return redirect()->back()->with('error', 'Post-event emails can only be sent after the event ends.');
        }

        $sentCount = 0;
        foreach ($event->registrations as $registration) {
            try {
                Mail::to($registration->user->email)->send(new PostEventMail($event, $registration->user));
                $sentCount++;
            } catch (\Exception $e) {
                // Log error but continue
                \Log::error('Failed to send post-event email to ' . $registration->user->email . ': ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('success', "Post-event emails sent to $sentCount participants!");
    }
}
