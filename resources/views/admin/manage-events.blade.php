@extends('layouts.admin')

@section('title', 'Manage Events')

@section('content')
<div class="manage-events">
    <h1>Manage Events</h1>
    
    <div class="actions">
        <a href="{{ route('organizer.events.create') }}" class="btn btn-primary">Create New Event</a>
    </div>
    
    <div class="events-list" style="margin-top: 2rem;">
        @php
            $events = \App\Models\Event::with(['organizer', 'registrations'])
                ->orderBy('event_date', 'desc')
                ->paginate(10);
        @endphp

        @if($events->count() > 0)
            <div style="background: white; border-radius: 15px; padding: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="border-bottom: 2px solid #e5e7eb;">
                            <th style="padding: 1rem; text-align: left; color: #666;">Event</th>
                            <th style="padding: 1rem; text-align: left; color: #666;">Date</th>
                            <th style="padding: 1rem; text-align: left; color: #666;">Organizer</th>
                            <th style="padding: 1rem; text-align: left; color: #666;">Participants</th>
                            <th style="padding: 1rem; text-align: left; color: #666;">Status</th>
                            <th style="padding: 1rem; text-align: left; color: #666;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 1rem;">
                                    <strong>{{ $event->title }}</strong>
                                </td>
                                <td style="padding: 1rem;">
                                    {{ $event->event_date->format('M d, Y') }}
                                </td>
                                <td style="padding: 1rem;">
                                    {{ $event->organizer->name }}
                                </td>
                                <td style="padding: 1rem;">
                                    {{ $event->registrations->count() }}/{{ $event->max_participants }}
                                </td>
                                <td style="padding: 1rem;">
                                    <span style="padding: 0.3rem 0.8rem; border-radius: 15px; font-size: 0.85rem; 
                                        @if($event->status === 'active') background: #d1fae5; color: #065f46;
                                        @elseif($event->status === 'completed') background: #e0e7ff; color: #3730a3;
                                        @else background: #fee2e2; color: #991b1b; @endif">
                                        {{ ucfirst($event->status) }}
                                    </span>
                                </td>
                                <td style="padding: 1rem;">
                                    <a href="{{ route('events.show', $event) }}" style="color: #667eea; text-decoration: none; margin-right: 1rem;">View</a>
                                    <a href="{{ route('organizer.events.edit', $event) }}" style="color: #667eea; text-decoration: none; margin-right: 1rem;">Edit</a>
                                    <form action="{{ route('organizer.events.destroy', $event) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure?')" style="color: #ef4444; background: none; border: none; cursor: pointer; text-decoration: underline;">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($events->hasPages())
                    <div style="margin-top: 2rem; display: flex; justify-content: center; gap: 0.5rem;">
                        @if ($events->onFirstPage())
                            <span style="opacity: 0.5; padding: 0.5rem 1rem;">← Previous</span>
                        @else
                            <a href="{{ $events->previousPageUrl() }}" style="padding: 0.5rem 1rem; text-decoration: none; color: #667eea;">← Previous</a>
                        @endif

                        @foreach ($events->getUrlRange(1, $events->lastPage()) as $page => $url)
                            @if ($page == $events->currentPage())
                                <span style="padding: 0.5rem 1rem; background: #667eea; color: white; border-radius: 5px;">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" style="padding: 0.5rem 1rem; text-decoration: none; color: #667eea;">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if ($events->hasMorePages())
                            <a href="{{ $events->nextPageUrl() }}" style="padding: 0.5rem 1rem; text-decoration: none; color: #667eea;">Next →</a>
                        @else
                            <span style="opacity: 0.5; padding: 0.5rem 1rem;">Next →</span>
                        @endif
                    </div>
                @endif
            </div>
        @else
            <div style="background: white; border-radius: 15px; padding: 3rem; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                <div style="font-size: 3rem; margin-bottom: 1rem;">📅</div>
                <h3>No events yet</h3>
                <p style="color: #666; margin: 1rem 0;">Create your first event to get started</p>
                <a href="{{ route('organizer.events.create') }}" class="btn btn-primary" style="margin-top: 1rem;">Create Event</a>
            </div>
        @endif
    </div>
</div>
@endsection
