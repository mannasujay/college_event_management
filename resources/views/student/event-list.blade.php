@extends('layouts.app')

@section('title', 'Events')

@section('content')
<div class="events-page">
    <div class="page-header-section">
        <div class="header-content">
            <div class="header-text">
                <h1>🎉 Available Events</h1>
                <p>Browse and register for upcoming college events</p>
            </div>
            <div class="header-stats">
                <div class="stat-item">
                    <span class="stat-number">{{ \App\Models\Event::where('status', 'active')->count() }}</span>
                    <span class="stat-label">Active Events</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ \App\Models\Registration::where('user_id', auth()->id())->count() }}</span>
                    <span class="stat-label">Your Registrations</span>
                </div>
            </div>
        </div>
    </div>

    @livewire('event-list')
</div>

<style>
    .events-page {
        padding-bottom: 3rem;
    }

    .page-header-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 3rem 2rem;
        margin: -2rem -2rem 2rem -2rem;
        border-radius: 0 0 30px 30px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    }

    .header-content {
        max-width: 1200px;
        margin: 0 auto;
    }

    .header-text h1 {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }

    .header-text p {
        font-size: 1.2rem;
        opacity: 0.95;
        margin-bottom: 2rem;
    }

    .header-stats {
        display: flex;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .stat-item {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        padding: 1.5rem 2rem;
        border-radius: 15px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        display: flex;
        flex-direction: column;
        align-items: center;
        min-width: 150px;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 0.9rem;
        opacity: 0.9;
        text-align: center;
    }

    @media (max-width: 768px) {
        .page-header-section {
            padding: 2rem 1rem;
            margin: -1rem -1rem 1.5rem -1rem;
        }

        .header-text h1 {
            font-size: 1.8rem;
        }

        .header-text p {
            font-size: 1rem;
        }

        .header-stats {
            gap: 1rem;
        }

        .stat-item {
            flex: 1;
            min-width: 120px;
            padding: 1rem 1.5rem;
        }

        .stat-number {
            font-size: 2rem;
        }
    }
</style>
@endsection
