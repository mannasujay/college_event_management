<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Organizer;

/*
|--------------------------------------------------------------------------
| Organizer Routes
|--------------------------------------------------------------------------
|
| Here is where you can register organizer routes for your application.
|
*/

Route::middleware(['auth', 'role:organizer,admin'])->prefix('organizer')->name('organizer.')->group(function () {
    Route::get('/dashboard', function () {
        $myEvents = \App\Models\Event::where('organizer_id', auth()->id())->count();
        $totalParticipants = \App\Models\Registration::whereHas('event', function($q) {
            $q->where('organizer_id', auth()->id());
        })->count();
        return view('organizer.dashboard', compact('myEvents', 'totalParticipants'));
    })->name('dashboard');
    
    // Event Management
    Route::get('/events', [\App\Http\Controllers\EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [\App\Http\Controllers\EventController::class, 'create'])->name('events.create');
    Route::post('/events', [\App\Http\Controllers\EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}/edit', [\App\Http\Controllers\EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [\App\Http\Controllers\EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [\App\Http\Controllers\EventController::class, 'destroy'])->name('events.destroy');
    
    Route::get('/feedbacks', function () {
        return view('organizer.feedbacks');
    })->name('feedbacks');
});
