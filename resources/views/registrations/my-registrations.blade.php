@extends('layouts.app')

@section('title', 'My Registrations')

@section('content')
<div class="container">
    <div class="page-header">
        <h1>📝 My Event Registrations</h1>
        <p>View and manage all your event registrations</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            ✓ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            ✗ {{ session('error') }}
        </div>
    @endif

    @if($registrations->count() > 0)
        <div class="registrations-grid">
            @foreach($registrations as $registration)
                <div class="registration-card">
                    <div class="registration-header">
                        <h3>{{ $registration->event->name }}</h3>
                        <span class="status-badge status-{{ $registration->status }}">
                            {{ ucfirst($registration->status) }}
                        </span>
                    </div>
                    
                    <div class="event-info">
                        <div class="info-item">
                            <span class="icon">📅</span>
                            <span>{{ \Carbon\Carbon::parse($registration->event->event_date)->format('d M Y, h:i A') }}</span>
                        </div>
                        <div class="info-item">
                            <span class="icon">📍</span>
                            <span>{{ $registration->event->location }}</span>
                        </div>
                        @if($registration->event->venue)
                        <div class="info-item">
                            <span class="icon">🏢</span>
                            <span>{{ $registration->event->venue }}</span>
                        </div>
                        @endif
                        <div class="info-item">
                            <span class="icon">🎯</span>
                            <span>{{ $registration->event->category }}</span>
                        </div>
                    </div>

                    <p class="event-description">
                        {{ Str::limit($registration->event->description, 150) }}
                    </p>

                    <div class="registration-meta">
                        <span class="registered-date">
                            ⏰ Registered: {{ $registration->created_at->format('d M Y') }}
                        </span>
                    </div>

                    <div class="registration-actions">
                        <a href="{{ route('events.show', $registration->event->id) }}" class="btn btn-view">
                            👁️ View Details
                        </a>
                        
                        @if($registration->status === 'registered' && \Carbon\Carbon::parse($registration->event->event_date)->isFuture())
                            <form method="POST" action="{{ route('events.unregister', $registration->event->id) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-cancel" onclick="return confirm('Are you sure you want to cancel this registration?')">
                                    ❌ Cancel Registration
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination-wrapper">
            {{ $registrations->links() }}
        </div>
    @else
        <div class="no-registrations">
            <div class="empty-icon">📋</div>
            <h3>No Registrations Yet</h3>
            <p>You haven't registered for any events yet. Browse available events to get started!</p>
            <a href="{{ route('events.index') }}" class="btn btn-primary">
                🔍 Browse Events
            </a>
        </div>
    @endif
</div>

<style>
    .page-header {
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #e1e8ed;
    }

    .page-header h1 {
        font-size: 2rem;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        font-weight: 700;
    }

    .page-header p {
        color: #666;
        font-size: 1rem;
    }

    .registrations-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .registration-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.8);
    }

    .registration-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    }

    .registration-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1.5rem;
        gap: 1rem;
    }

    .registration-header h3 {
        font-size: 1.4rem;
        color: #2c3e50;
        margin: 0;
        flex: 1;
    }

    .status-badge {
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        white-space: nowrap;
    }

    .status-registered {
        background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
        color: white;
    }

    .status-attended {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
    }

    .status-cancelled {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }

    .event-info {
        display: flex;
        flex-direction: column;
        gap: 0.8rem;
        margin-bottom: 1.5rem;
        padding: 1.5rem;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 20%);
        border-radius: 12px;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        font-size: 0.95rem;
        color: #555;
    }

    .info-item .icon {
        font-size: 1.2rem;
    }

    .event-description {
        color: #666;
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    .registration-meta {
        padding: 1rem 0;
        border-top: 1px solid #e1e8ed;
        border-bottom: 1px solid #e1e8ed;
        margin-bottom: 1.5rem;
    }

    .registered-date {
        font-size: 0.9rem;
        color: #667eea;
        font-weight: 500;
    }

    .registration-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .btn {
        padding: 0.8rem 1.5rem;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        display: inline-block;
    }

    .btn-view {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        flex: 1;
    }

    .btn-view:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-cancel {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        flex: 1;
    }

    .btn-cancel:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
    }

    .no-registrations {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .empty-icon {
        font-size: 5rem;
        margin-bottom: 1.5rem;
        opacity: 0.7;
    }

    .no-registrations h3 {
        font-size: 1.8rem;
        color: #2c3e50;
        margin-bottom: 1rem;
    }

    .no-registrations p {
        color: #666;
        font-size: 1.1rem;
        margin-bottom: 2rem;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1rem 2rem;
        font-size: 1.1rem;
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
    }

    @media (max-width: 768px) {
        .registrations-grid {
            grid-template-columns: 1fr;
        }

        .registration-header {
            flex-direction: column;
        }

        .registration-actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            text-align: center;
        }
    }
</style>
@endsection
