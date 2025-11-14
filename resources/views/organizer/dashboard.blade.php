@extends('layouts.app')

@section('title', 'Organizer Dashboard')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');
    
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Inter', sans-serif;
    }
    
    .organizer-dashboard {
        min-height: 100vh;
        background: #f8fafc;
        padding: 2.5rem 1.5rem;
    }
    
    .dashboard-container {
        max-width: 1400px;
        margin: 0 auto;
    }
    
    .dashboard-header {
        margin-bottom: 3rem;
        animation: fadeInDown 0.5s ease-out;
    }
    
    .dashboard-header h1 {
        font-size: 2.75rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 0.5rem;
        letter-spacing: -1px;
    }
    
    .dashboard-header p {
        color: #64748b;
        font-size: 1.125rem;
        font-weight: 500;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
        animation: fadeInUp 0.5s ease-out 0.1s both;
    }
    
    .stat-card {
        background: white;
        padding: 2rem;
        border-radius: 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid #e2e8f0;
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
        background: linear-gradient(90deg, #6366f1 0%, #8b5cf6 100%);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease;
    }
    
    .stat-card:hover::before {
        transform: scaleX(1);
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        border-color: #cbd5e0;
    }
    
    .stat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
    }
    
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        background: linear-gradient(135deg, #6366f110 0%, #8b5cf610 100%);
        transition: all 0.3s ease;
    }
    
    .stat-card:hover .stat-icon {
        transform: scale(1.1) rotate(5deg);
        background: linear-gradient(135deg, #6366f120 0%, #8b5cf620 100%);
    }
    
    .stat-content h3 {
        font-size: 0.875rem;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.75rem;
    }
    
    .stat-number {
        font-size: 2.75rem;
        font-weight: 800;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1;
    }
    
    .actions-section {
        margin-bottom: 3rem;
        animation: fadeInUp 0.5s ease-out 0.2s both;
    }
    
    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2rem;
    }
    
    .section-header h2 {
        font-size: 1.875rem;
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.5px;
    }
    
    .actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 1.5rem;
    }
    
    .action-card {
        background: white;
        padding: 2.5rem;
        border-radius: 20px;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid #e2e8f0;
        position: relative;
        overflow: hidden;
        display: block;
    }
    
    .action-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 0;
    }
    
    .action-card:hover::before {
        opacity: 1;
    }
    
    .action-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px rgba(99, 102, 241, 0.25);
        border-color: transparent;
    }
    
    .action-content {
        position: relative;
        z-index: 1;
        transition: all 0.3s ease;
    }
    
    .action-icon-wrapper {
        width: 70px;
        height: 70px;
        border-radius: 18px;
        background: linear-gradient(135deg, #6366f110 0%, #8b5cf610 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        font-size: 2.25rem;
        transition: all 0.3s ease;
    }
    
    .action-card:hover .action-icon-wrapper {
        background: rgba(255, 255, 255, 0.2);
        transform: scale(1.15) rotate(-5deg);
    }
    
    .action-content h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 0.75rem;
        transition: color 0.3s ease;
    }
    
    .action-card:hover .action-content h3 {
        color: white;
    }
    
    .action-content p {
        color: #64748b;
        font-size: 1rem;
        line-height: 1.6;
        margin: 0;
        font-weight: 500;
        transition: color 0.3s ease;
    }
    
    .action-card:hover .action-content p {
        color: rgba(255, 255, 255, 0.9);
    }
    
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @media (max-width: 768px) {
        .dashboard-header h1 {
            font-size: 2.25rem;
        }
        
        .stats-grid,
        .actions-grid {
            grid-template-columns: 1fr;
        }
        
        .stat-number {
            font-size: 2.25rem;
        }
    }
</style>

<div class="organizer-dashboard">
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>Welcome back, {{ Auth::user()->name }}!</h1>
            <p>Here's what's happening with your events today</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">📅</div>
                </div>
                <div class="stat-content">
                    <h3>Total Events</h3>
                    <div class="stat-number">{{ $totalEvents ?? 8 }}</div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">👥</div>
                </div>
                <div class="stat-content">
                    <h3>Participants</h3>
                    <div class="stat-number">{{ $totalParticipants ?? 150 }}</div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">⭐</div>
                </div>
                <div class="stat-content">
                    <h3>Avg Rating</h3>
                    <div class="stat-number">{{ $avgRating ?? '4.5' }}</div>
                </div>
            </div>
        </div>

        <div class="actions-section">
            <div class="section-header">
                <h2>Quick Actions</h2>
            </div>
            
            <div class="actions-grid">
                <a href="{{ route('organizer.events.create') }}" class="action-card">
                    <div class="action-content">
                        <div class="action-icon-wrapper">➕</div>
                        <h3>Create Event</h3>
                        <p>Set up a new event and start accepting registrations</p>
                    </div>
                </a>
                
                <a href="{{ route('organizer.events.index') }}" class="action-card">
                    <div class="action-content">
                        <div class="action-icon-wrapper">⚙️</div>
                        <h3>Manage Events</h3>
                        <p>View, edit, or delete your existing events</p>
                    </div>
                </a>
                
                <a href="{{ route('organizer.feedbacks') }}" class="action-card">
                    <div class="action-content">
                        <div class="action-icon-wrapper">💬</div>
                        <h3>View Feedback</h3>
                        <p>Check participant reviews and ratings</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
