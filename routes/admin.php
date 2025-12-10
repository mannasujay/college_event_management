<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application.
|
*/

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
    // User Management Routes
    Route::get('/users', function () {
        $users = \App\Models\User::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.users', compact('users'));
    })->name('users');
    
    Route::post('/users/{user}/change-role', function (\App\Models\User $user) {
        $validated = request()->validate([
            'role' => ['required', 'in:student,organizer,admin'],
        ]);
        
        $user->update(['role' => $validated['role']]);
        
        return back()->with('success', "User role updated to {$validated['role']} successfully!");
    })->name('users.change-role');
    
    Route::get('/manage-events', function () {
        return view('admin.manage-events');
    })->name('manage-events');
    
    Route::get('/participants', function () {
        return view('admin.participants');
    })->name('participants');
    
    Route::get('/results', function () {
        return view('admin.results');
    })->name('results');
    
    Route::get('/announcements', function () {
        $announcements = \App\Models\Announcement::with('creator')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.announcements', compact('announcements'));
    })->name('announcements');
    
    // Announcement Management
    Route::get('/announcements/create', function () {
        return view('admin.announcements-create');
    })->name('announcements.create');
    
    Route::post('/announcements', function () {
        $validated = request()->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'priority' => 'required|in:low,medium,high',
        ]);
        
        $validated['created_by'] = Auth::id();
        
        \App\Models\Announcement::create($validated);
        
        return redirect()->route('admin.announcements')->with('success', 'Announcement created successfully!');
    })->name('announcements.store');
    
    Route::delete('/announcements/{announcement}', function (\App\Models\Announcement $announcement) {
        $announcement->delete();
        return back()->with('success', 'Announcement deleted successfully!');
    })->name('announcements.destroy');
});
