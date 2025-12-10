<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventPhotoController extends Controller
{
    public function index($eventId)
    {
        $event = Event::with(['photos.uploader'])->findOrFail($eventId);
        
        // Check if event has ended
        if ($event->event_date > now()) {
            return redirect()->back()->with('error', 'Photos will be available after the event ends.');
        }

        return view('events.gallery', compact('event'));
    }

    public function store(Request $request, $eventId)
    {
        $event = Event::findOrFail($eventId);
        
        // Check if user is admin or organizer
        $user = Auth::user();
        if (!in_array($user->role, ['admin', 'organizer'])) {
            return redirect()->back()->with('error', 'Only admins and organizers can upload photos.');
        }
        
        // Check if event has ended
        if ($event->event_date > now()) {
            return redirect()->back()->with('error', 'Photos can only be uploaded after the event ends.');
        }

        $request->validate([
            'photos.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'captions.*' => 'nullable|string|max:255'
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $photo) {
                $path = $photo->store('event-photos/' . $eventId, 'public');
                
                EventPhoto::create([
                    'event_id' => $eventId,
                    'uploaded_by' => Auth::id(),
                    'photo_path' => $path,
                    'caption' => $request->captions[$index] ?? null,
                    'order' => EventPhoto::where('event_id', $eventId)->count()
                ]);
            }
        }

        return redirect()->back()->with('success', 'Photos uploaded successfully!');
    }

    public function destroy($id)
    {
        $photo = EventPhoto::findOrFail($id);
        $user = Auth::user();
        
        // Only allow deletion if user is admin, organizer, or the uploader
        if (!in_array($user->role, ['admin', 'organizer']) && $photo->uploaded_by !== $user->id) {
            return redirect()->back()->with('error', 'You do not have permission to delete this photo.');
        }
        
        // Delete file from storage
        if (Storage::disk('public')->exists($photo->photo_path)) {
            Storage::disk('public')->delete($photo->photo_path);
        }
        
        $photo->delete();

        return redirect()->back()->with('success', 'Photo deleted successfully!');
    }
}
