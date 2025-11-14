<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventArchiveController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::where('event_date', '<', now())
            ->with(['organizer', 'registrations']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by year
        if ($request->filled('year')) {
            $query->whereYear('event_date', $request->year);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $events = $query->orderBy('event_date', 'desc')->paginate(12);

        // Get available years for filter
        $years = Event::where('event_date', '<', now())
            ->selectRaw('YEAR(event_date) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('events.archive', compact('events', 'years'));
    }
}
