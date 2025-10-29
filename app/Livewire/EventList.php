<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Event;

class EventList extends Component
{
    public function render()
    {
        $events = Event::where('status', 'active')
                      ->orderBy('event_date', 'asc')
                      ->get();
                      
        return view('livewire.event-list', [
            'events' => $events
        ]);
    }
}
