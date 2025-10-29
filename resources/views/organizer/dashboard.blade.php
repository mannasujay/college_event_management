@extends('layouts.app')

@section('title', 'Organizer Dashboard')

@section('content')
<div class="container">
    <div class="dashboard-header">
        <h1>Welcome, {{ Auth::user()->name }}!</h1>
        <p>Organizer Dashboard</p>
    </div>

    <div class="dashboard-stats">
        <div class="stat-card">
            <div class="stat-icon">📅</div>
            <div class="stat-info">
                <h3>Total Events</h3>
                <p class="stat-number">8</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">👥</div>
            <div class="stat-info">
                <h3>Total Participants</h3>
                <p class="stat-number">150</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">⭐</div>
            <div class="stat-info">
                <h3>Average Rating</h3>
                <p class="stat-number">4.5</p>
            </div>
        </div>
    </div>

    <div class="dashboard-actions">
        <h2>Quick Actions</h2>
        <div class="action-grid">
            <a href="{{ route('organizer.events.create') }}" class="action-card">
                <div class="action-icon">➕</div>
                <h3>Create Event</h3>
                <p>Add a new event</p>
            </a>
            
            <a href="{{ route('organizer.events.index') }}" class="action-card">
                <div class="action-icon">⚙️</div>
                <h3>Manage Events</h3>
                <p>Edit or delete events</p>
            </a>
            
            <a href="{{ route('organizer.feedbacks') }}" class="action-card">
                <div class="action-icon">💬</div>
                <h3>View Feedbacks</h3>
                <p>Check participant feedback</p>
            </a>
        </div>
    </div>
</div>

<style>
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.dashboard-header {
    margin-bottom: 2rem;
}

.dashboard-header h1 {
    font-size: 2rem;
    color: #333;
    margin-bottom: 0.5rem;
}

.dashboard-header p {
    color: #666;
    font-size: 1.1rem;
}

.dashboard-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
}

.stat-card {
    background: white;
    padding: 1.5rem;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
    gap: 1rem;
}

.stat-icon {
    font-size: 2.5rem;
}

.stat-info h3 {
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 0.5rem;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: #667eea;
    margin: 0;
}

.dashboard-actions h2 {
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
    color: #333;
}

.action-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.action-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 2rem;
    border-radius: 10px;
    text-decoration: none;
    transition: transform 0.3s, box-shadow 0.3s;
}

.action-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
}

.action-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.action-card h3 {
    font-size: 1.3rem;
    margin-bottom: 0.5rem;
}

.action-card p {
    opacity: 0.9;
    margin: 0;
}
</style>
@endsection
