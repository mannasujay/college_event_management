@extends('layouts.admin')

@section('title', 'Admin-Dashboard')

@section('content')
<style>
    .admin-dashboard {
        padding: 2rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }

    .dashboard-header {
        background: white;
        padding: 2rem;
        border-radius: 20px;
        margin-bottom: 2rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
        animation: slideDown 0.6s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dashboard-header h1 {
        font-size: 2.5rem;
        color: #333;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .welcome-text {
        color: #666;
        font-size: 1rem;
        margin-top: 0.5rem;
    }

    .user-info {
        text-align: right;
    }

    .user-name {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
    }

    .user-role {
        color: #667eea;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .quick-actions {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    .action-btn {
        padding: 1rem 2rem;
        background: white;
        color: #667eea;
        text-decoration: none;
        border-radius: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .action-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .stats-container {
        margin-bottom: 2rem;
    }

    .management-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }

    .management-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        transition: all 0.3s;
        animation: fadeIn 0.6s ease-out;
        position: relative;
        overflow: hidden;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .management-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .management-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
    }

    .card-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    .card-title {
        font-size: 1.5rem;
        color: #333;
        margin-bottom: 0.5rem;
        font-weight: 700;
    }

    .card-count {
        font-size: 3rem;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 1rem 0;
    }

    .card-description {
        color: #666;
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .card-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.8rem 1.5rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        text-decoration: none;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .card-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    .recent-activity {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        margin-top: 2rem;
    }

    .recent-activity h2 {
        color: #333;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .activity-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .activity-item {
        padding: 1rem;
        background: #f9fafb;
        border-radius: 10px;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: all 0.3s;
    }

    .activity-item:hover {
        background: #f3f4f6;
        transform: translateX(5px);
    }

    .activity-icon {
        font-size: 1.5rem;
    }

    .activity-content h4 {
        color: #333;
        font-size: 1rem;
        margin-bottom: 0.3rem;
    }

    .activity-content p {
        color: #666;
        font-size: 0.9rem;
    }

    @media (max-width: 768px) {
        .admin-dashboard {
            padding: 1rem;
        }

        .dashboard-header {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }

        .user-info {
            text-align: center;
        }

        .management-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="admin-dashboard">
    <div class="dashboard-header">
        <div>
            <h1>👨‍💼 Admin Dashboard</h1>
            <p class="welcome-text">Welcome back, {{ auth()->user()->name }}!</p>
        </div>
        <div class="user-info">
            <div class="user-name">{{ auth()->user()->name }}</div>
            <div class="user-role">Administrator</div>
        </div>
    </div>

    <div class="quick-actions">
        <a href="{{ route('admin.users') }}" class="action-btn">
            👥 Manage Users
        </a>
        <a href="{{ route('events.index') }}" class="action-btn">
            📅 View Events
        </a>
        <a href="{{ route('organizer.events.create') }}" class="action-btn">
            ➕ Create Event
        </a>
        <a href="{{ route('home') }}" class="action-btn">
            🏠 Visit Site
        </a>
    </div>

    <div class="stats-container">
        @livewire('dashboard-stats')
    </div>

    <div class="management-grid">
        <div class="management-card">
            <div class="card-icon">👥</div>
            <h3 class="card-title">User Management</h3>
            <div class="card-count">{{ \App\Models\User::count() }}</div>
            <p class="card-description">
                Manage user roles, permissions, and access levels. Promote students to organizers or admins.
            </p>
            <a href="{{ route('admin.users') }}" class="card-btn">
                Manage Users →
            </a>
        </div>

        <div class="management-card">
            <div class="card-icon">📅</div>
            <h3 class="card-title">Event Management</h3>
            <div class="card-count">{{ \App\Models\Event::count() }}</div>
            <p class="card-description">
                View all events, create new ones, and manage existing events across the platform.
            </p>
            <a href="{{ route('events.index') }}" class="card-btn">
                View Events →
            </a>
        </div>

        <div class="management-card">
            <div class="card-icon">📝</div>
            <h3 class="card-title">Registrations</h3>
            <div class="card-count">{{ \App\Models\Registration::count() }}</div>
            <p class="card-description">
                Monitor event registrations, participant lists, and attendance tracking.
            </p>
            <a href="{{ route('events.index') }}" class="card-btn">
                View Details →
            </a>
        </div>

        <div class="management-card">
            <div class="card-icon">✅</div>
            <h3 class="card-title">Active Events</h3>
            <div class="card-count">{{ \App\Models\Event::where('status', 'active')->count() }}</div>
            <p class="card-description">
                Currently active events that are open for registration and participation.
            </p>
            <a href="{{ route('events.index') }}" class="card-btn">
                Browse Active →
            </a>
        </div>

        <div class="management-card">
            <div class="card-icon">📊</div>
            <h3 class="card-title">Organizers</h3>
            <div class="card-count">{{ \App\Models\User::where('role', 'organizer')->count() }}</div>
            <p class="card-description">
                Total number of event organizers who can create and manage events.
            </p>
            <a href="{{ route('admin.users') }}" class="card-btn">
                View Organizers →
            </a>
        </div>

        <div class="management-card">
            <div class="card-icon">🎓</div>
            <h3 class="card-title">Students</h3>
            <div class="card-count">{{ \App\Models\User::where('role', 'student')->count() }}</div>
            <p class="card-description">
                Total students registered on the platform who can participate in events.
            </p>
            <a href="{{ route('admin.users') }}" class="card-btn">
                View Students →
            </a>
        </div>
    </div>

    <div class="recent-activity">
        <h2>📈 Recent Activity</h2>
        <div class="activity-list">
            @php
                $recentEvents = \App\Models\Event::orderBy('created_at', 'desc')->take(5)->get();
            @endphp
            @forelse($recentEvents as $event)
                <div class="activity-item">
                    <div class="activity-icon">📅</div>
                    <div class="activity-content">
                        <h4>New Event: {{ $event->title }}</h4>
                        <p>Created {{ $event->created_at->diffForHumans() }} • {{ $event->registrations->count() }} registrations</p>
                    </div>
                </div>
            @empty
                <div class="activity-item">
                    <div class="activity-icon">📭</div>
                    <div class="activity-content">
                        <h4>No recent activity</h4>
                        <p>Create your first event to see activity here</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
