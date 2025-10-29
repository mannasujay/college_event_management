<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Event;
use App\Models\User;
use App\Models\Registration;

class DashboardStats extends Component
{
    public function render()
    {
        $stats = [
            'total_events' => Event::count(),
            'active_events' => Event::where('status', 'active')->count(),
            'total_users' => User::count(),
            'total_registrations' => Registration::count(),
            'upcoming_events' => Event::where('status', 'active')
                ->where('event_date', '>=', now())
                ->count(),
        ];

        return view('livewire.dashboard-stats', compact('stats'));
    }
}
