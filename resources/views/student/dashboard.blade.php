@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
<div class="dashboard-container">
    <div class="welcome-banner">
        <div class="welcome-content">
            <div class="welcome-text">
                <h1>👋 Welcome back, {{ Auth::user()->name }}!</h1>
                <p>Here's your event activity overview</p>
            </div>
            <div class="user-badge">
                <div class="badge-icon">🎓</div>
                <div class="badge-text">Student</div>
            </div>
        </div>
    </div>

    <div class="dashboard-stats">
        <div class="stat-card purple">
            <div class="stat-icon-bg">
                <div class="stat-icon">📅</div>
            </div>
            <div class="stat-info">
                <p class="stat-label">Upcoming Events</p>
                <h3 class="stat-number">{{ $upcomingEvents }}</h3>
            </div>
            <div class="stat-footer">
                <a href="{{ route('student.event-list') }}">View all →</a>
            </div>
        </div>
        
        <div class="stat-card blue">
            <div class="stat-icon-bg">
                <div class="stat-icon">✅</div>
            </div>
            <div class="stat-info">
                <p class="stat-label">My Registrations</p>
                <h3 class="stat-number">{{ $myRegistrations }}</h3>
            </div>
            <div class="stat-footer">
                <a href="{{ route('my-registrations') }}">View all →</a>
            </div>
        </div>
        
        <div class="stat-card green">
            <div class="stat-icon-bg">
                <div class="stat-icon">🏆</div>
            </div>
            <div class="stat-info">
                <p class="stat-label">Completed Events</p>
                <h3 class="stat-number">{{ \App\Models\Registration::where('user_id', auth()->id())->where('status', 'attended')->count() }}</h3>
            </div>
            <div class="stat-footer">
                <span>Keep it up! 🎉</span>
            </div>
        </div>
    </div>

    <div class="dashboard-actions">
        <h2>⚡ Quick Actions</h2>
        <div class="action-grid">
            <a href="{{ route('student.event-list') }}" class="action-card">
                <div class="action-icon-wrapper purple">
                    <div class="action-icon">📋</div>
                </div>
                <h3>Browse Events</h3>
                <p>Discover and register for upcoming events</p>
                <span class="action-arrow">→</span>
            </a>
            
            <a href="{{ route('my-registrations') }}" class="action-card">
                <div class="action-icon-wrapper blue">
                    <div class="action-icon">📝</div>
                </div>
                <h3>My Registrations</h3>
                <p>View and manage your event registrations</p>
                <span class="action-arrow">→</span>
            </a>
            
            <a href="{{ route('student.feedback') }}" class="action-card">
                <div class="action-icon-wrapper green">
                    <div class="action-icon">💬</div>
                </div>
                <h3>Give Feedback</h3>
                <p>Share your experience and suggestions</p>
                <span class="action-arrow">→</span>
            </a>
            
            <a href="{{ route('events.index') }}" class="action-card">
                <div class="action-icon-wrapper orange">
                    <div class="action-icon">🔍</div>
                </div>
                <h3>Explore Events</h3>
                <p>Find events that match your interests</p>
                <span class="action-arrow">→</span>
            </a>
        </div>
    </div>

    <div class="info-section">
        <div class="info-card">
            <div class="info-icon">💡</div>
            <h3>Quick Tips</h3>
            <ul>
                <li>Register early to secure your spot</li>
                <li>Check event details before registering</li>
                <li>Provide feedback after attending events</li>
                <li>Stay updated with event announcements</li>
            </ul>
        </div>
    </div>
</div>

<style>
.dashboard-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 1rem 3rem 1rem;
}

.welcome-banner {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 3rem 2rem;
    margin: -2rem -1rem 2rem -1rem;
    border-radius: 0 0 30px 30px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
}

.welcome-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1400px;
    margin: 0 auto;
    gap: 2rem;
}

.welcome-text h1 {
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
    font-weight: 700;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
}

.welcome-text p {
    font-size: 1.2rem;
    opacity: 0.95;
}

.user-badge {
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    padding: 1.5rem;
    border-radius: 20px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    text-align: center;
    min-width: 120px;
}

.badge-icon {
    font-size: 3rem;
    margin-bottom: 0.5rem;
}

.badge-text {
    font-size: 1.1rem;
    font-weight: 600;
}

.dashboard-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.stat-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    border: 2px solid transparent;
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
}

.stat-card.purple::before {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.stat-card.blue::before {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
}

.stat-card.green::before {
    background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
}

.stat-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 45px rgba(0, 0, 0, 0.15);
}

.stat-icon-bg {
    width: 70px;
    height: 70px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.5rem;
}

.stat-card.purple .stat-icon-bg {
    background: linear-gradient(135deg, #667eea20 0%, #764ba220 100%);
}

.stat-card.blue .stat-icon-bg {
    background: linear-gradient(135deg, #3b82f620 0%, #2563eb20 100%);
}

.stat-card.green .stat-icon-bg {
    background: linear-gradient(135deg, #22c55e20 0%, #16a34a20 100%);
}

.stat-icon {
    font-size: 2.5rem;
}

.stat-label {
    font-size: 0.95rem;
    color: #666;
    margin-bottom: 0.5rem;
    font-weight: 500;
}

.stat-number {
    font-size: 3rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0;
    line-height: 1;
}

.stat-footer {
    margin-top: 1.5rem;
    padding-top: 1rem;
    border-top: 1px solid #e1e8ed;
}

.stat-footer a {
    color: #667eea;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.stat-footer a:hover {
    color: #764ba2;
}

.stat-footer span {
    color: #666;
    font-size: 0.9rem;
}

.dashboard-actions {
    margin-bottom: 3rem;
}

.dashboard-actions h2 {
    font-size: 1.8rem;
    color: #2c3e50;
    margin-bottom: 1.5rem;
    font-weight: 700;
}

.action-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 1.5rem;
}

.action-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 2px solid #e1e8ed;
    position: relative;
    overflow: hidden;
}

.action-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 35px rgba(0, 0, 0, 0.15);
    border-color: #667eea;
}

.action-icon-wrapper {
    width: 60px;
    height: 60px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.5rem;
}

.action-icon-wrapper.purple {
    background: linear-gradient(135deg, #667eea20 0%, #764ba220 100%);
}

.action-icon-wrapper.blue {
    background: linear-gradient(135deg, #3b82f620 0%, #2563eb20 100%);
}

.action-icon-wrapper.green {
    background: linear-gradient(135deg, #22c55e20 0%, #16a34a20 100%);
}

.action-icon-wrapper.orange {
    background: linear-gradient(135deg, #f59e0b20 0%, #d97706200 100%);
}

.action-icon-wrapper .action-icon {
    font-size: 2rem;
}

.action-card h3 {
    font-size: 1.3rem;
    color: #2c3e50;
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.action-card p {
    color: #666;
    font-size: 0.95rem;
    line-height: 1.5;
    margin-bottom: 0;
}

.action-arrow {
    position: absolute;
    right: 1.5rem;
    bottom: 1.5rem;
    font-size: 1.5rem;
    color: #667eea;
    opacity: 0;
    transition: all 0.3s ease;
}

.action-card:hover .action-arrow {
    opacity: 1;
    right: 1rem;
}

.info-section {
    margin-top: 3rem;
}

.info-card {
    background: linear-gradient(135deg, #fff9e6 0%, #fff3cd 100%);
    border-radius: 20px;
    padding: 2rem;
    border-left: 5px solid #ffc107;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.info-icon {
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.info-card h3 {
    font-size: 1.5rem;
    color: #2c3e50;
    margin-bottom: 1rem;
    font-weight: 600;
}

.info-card ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.info-card ul li {
    padding: 0.75rem 0;
    color: #555;
    font-size: 1rem;
    display: flex;
    align-items: center;
}

.info-card ul li::before {
    content: '✓';
    color: #22c55e;
    font-weight: bold;
    font-size: 1.2rem;
    margin-right: 1rem;
}

@media (max-width: 768px) {
    .welcome-banner {
        padding: 2rem 1rem;
        margin: -1rem -1rem 1.5rem -1rem;
    }

    .welcome-content {
        flex-direction: column;
        text-align: center;
    }

    .welcome-text h1 {
        font-size: 1.8rem;
    }

    .welcome-text p {
        font-size: 1rem;
    }

    .dashboard-stats {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .action-grid {
        grid-template-columns: 1fr;
    }

    .action-arrow {
        display: none;
    }
}
</style>
@endsection
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
