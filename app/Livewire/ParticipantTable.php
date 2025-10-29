<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Registration;

class ParticipantTable extends Component
{
    use WithPagination;

    public $search = '';
    public $eventFilter = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $registrations = Registration::with(['user', 'event'])
            ->when($this->search, function($query) {
                $query->whereHas('user', function($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->eventFilter, function($query) {
                $query->where('event_id', $this->eventFilter);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $events = \App\Models\Event::orderBy('title')->get();

        return view('livewire.participant-table', compact('registrations', 'events'));
    }
}
