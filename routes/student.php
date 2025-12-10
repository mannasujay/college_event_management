<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student;

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register student routes for your application.
|
*/

Route::middleware(['auth', 'role:student,organizer,admin'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', function () {
        $upcomingEvents = \App\Models\Event::where('status', 'active')
            ->where('event_date', '>=', now())
            ->count();
        $myRegistrations = \App\Models\Registration::where('user_id', Auth::id())->count();
        return view('student.dashboard', compact('upcomingEvents', 'myRegistrations'));
    })->name('dashboard');
    
    Route::get('/event-list', function () {
        $events = \App\Models\Event::where('status', 'active')
            ->orderBy('event_date', 'asc')
            ->paginate(9);
        return view('student.event-list', compact('events'));
    })->name('event-list');
    
    Route::get('/feedback', function () {
        // Get only COMPLETED events (event_date has passed) that user has registered for
        $attendedEvents = \App\Models\Event::whereHas('registrations', function($query) {
            $query->where('user_id', Auth::id())
                  ->whereIn('status', ['registered', 'attended']);
        })
        ->where('event_date', '<', now()) // Only completed events
        ->orderBy('event_date', 'desc')
        ->get();
        
        return view('student.feedback', compact('attendedEvents'));
    })->name('feedback');
    
    Route::post('/submit-feedback', function () {
        request()->validate([
            'event_id' => 'required|exists:events,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);
        
        // Get the event
        $event = \App\Models\Event::findOrFail(request('event_id'));
        
        // Check if event has been completed
        if ($event->event_date >= now()) {
            return back()->with('error', '⏳ You can only provide feedback after the event has been completed!');
        }
        
        // Check if user attended this event
        $registration = \App\Models\Registration::where('user_id', Auth::id())
            ->where('event_id', request('event_id'))
            ->first();
            
        if (!$registration) {
            return back()->with('error', '❌ You must be registered for this event to give feedback!');
        }
        
        // Check if feedback already submitted
        $existingFeedback = \App\Models\Feedback::where('user_id', Auth::id())
            ->where('event_id', request('event_id'))
            ->first();
            
        if ($existingFeedback) {
            return back()->with('error', '📝 You have already submitted feedback for this event!');
        }
        
        // Create feedback
        \App\Models\Feedback::create([
            'event_id' => request('event_id'),
            'user_id' => Auth::id(),
            'rating' => request('rating'),
            'comment' => request('comment'),
        ]);
        
        return back()->with('success', '🎉 Thank you for your feedback!');
    })->name('submit-feedback');
    
    // Event Registration Routes
    Route::get('/register-event/{id}', function ($id) {
        $event = \App\Models\Event::findOrFail($id);
        return view('student.register-event', compact('event', 'id'));
    })->name('register-event');
    
    Route::post('/register-event/{id}', function ($id) {
        $event = \App\Models\Event::findOrFail($id);
        
        // Check if already registered
        $existingRegistration = \App\Models\Registration::where('event_id', $id)
            ->where('user_id', Auth::id())
            ->first();
            
        if ($existingRegistration) {
            return back()->with('error', 'You are already registered for this event!');
        }
        
        // Check capacity
        $currentRegistrations = \App\Models\Registration::where('event_id', $id)->count();
        if ($currentRegistrations >= $event->max_participants) {
            return back()->with('error', 'Sorry, this event is full!');
        }
        
        // Create registration
        \App\Models\Registration::create([
            'event_id' => $id,
            'user_id' => Auth::id(),
            'status' => 'registered',
        ]);
        
        return redirect()->route('my-registrations')->with('success', 'Successfully registered for the event!');
    })->name('register-event-submit');
});
