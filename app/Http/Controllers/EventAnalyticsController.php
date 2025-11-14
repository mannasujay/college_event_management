<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use App\Models\Feedback;
use Illuminate\Http\Request;

class EventAnalyticsController extends Controller
{
    public function show($eventId)
    {
        $event = Event::with(['registrations', 'feedback'])->findOrFail($eventId);

        // Calculate statistics
        $totalRegistrations = $event->registrations->count();
        $attendedCount = $event->registrations->where('status', 'attended')->count();
        $cancelledCount = $event->registrations->where('status', 'cancelled')->count();
        $attendanceRate = $totalRegistrations > 0 ? round(($attendedCount / $totalRegistrations) * 100, 2) : 0;

        // Feedback statistics
        $totalFeedback = $event->feedback->count();
        $averageRating = $event->feedback->avg('rating') ?? 0;
        
        // Rating distribution
        $ratingDistribution = [
            5 => $event->feedback->where('rating', 5)->count(),
            4 => $event->feedback->where('rating', 4)->count(),
            3 => $event->feedback->where('rating', 3)->count(),
            2 => $event->feedback->where('rating', 2)->count(),
            1 => $event->feedback->where('rating', 1)->count(),
        ];

        // Department-wise registration
        $departmentStats = $event->registrations()
            ->join('users', 'registrations.user_id', '=', 'users.id')
            ->selectRaw('users.department, COUNT(*) as count')
            ->groupBy('users.department')
            ->get();

        return view('events.analytics', compact(
            'event',
            'totalRegistrations',
            'attendedCount',
            'cancelledCount',
            'attendanceRate',
            'totalFeedback',
            'averageRating',
            'ratingDistribution',
            'departmentStats'
        ));
    }
}
