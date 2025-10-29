<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events - College Event Management</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 2rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .header h1 {
            font-size: 2rem;
            color: #333;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .header-actions {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .success-message, .error-message {
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            animation: slideIn 0.5s ease-out;
        }

        .success-message {
            background: #d1fae5;
            color: #065f46;
            border-left: 4px solid #10b981;
        }

        .error-message {
            background: #fee2e2;
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .event-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .event-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
        }

        .event-content {
            padding: 1.5rem;
        }

        .event-title {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .event-meta {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin: 1rem 0;
            color: #666;
            font-size: 0.95rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .event-description {
            color: #666;
            line-height: 1.6;
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .event-status {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }

        .status-active {
            background: #d1fae5;
            color: #065f46;
        }

        .status-completed {
            background: #e0e7ff;
            color: #3730a3;
        }

        .status-cancelled {
            background: #fee2e2;
            color: #991b1b;
        }

        .event-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .btn-small {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }

        .pagination {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            display: flex;
            justify-content: center;
            gap: 0.5rem;
        }

        .pagination a,
        .pagination span {
            padding: 0.5rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            color: #667eea;
            text-decoration: none;
            transition: all 0.3s;
        }

        .pagination a:hover {
            background: #667eea;
            color: white;
        }

        .pagination .active {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }

        .no-events {
            background: white;
            padding: 4rem 2rem;
            border-radius: 15px;
            text-align: center;
            color: #666;
        }

        .no-events-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .events-grid {
                grid-template-columns: 1fr;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📅 All Events</h1>
            <div class="header-actions">
                @if(auth()->user()->role === 'organizer' || auth()->user()->role === 'admin')
                    <a href="{{ route('organizer.events.create') }}" class="btn">+ Create Event</a>
                @endif
                <a href="{{ url('/dashboard') }}" class="btn btn-secondary">← Dashboard</a>
            </div>
        </div>

        @if(session('success'))
            <div class="success-message">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="error-message">
                ✗ {{ session('error') }}
            </div>
        @endif

        @if($events->count() > 0)
            <div class="events-grid">
                @foreach($events as $event)
                    <div class="event-card">
                        <div class="event-image">
                            🎉
                        </div>
                        <div class="event-content">
                            <span class="event-status status-{{ $event->status }}">
                                {{ $event->status }}
                            </span>
                            <h2 class="event-title">{{ $event->title }}</h2>
                            <div class="event-meta">
                                <div class="meta-item">
                                    📅 {{ $event->event_date->format('M d, Y') }}
                                </div>
                                <div class="meta-item">
                                    📍 {{ $event->location }}
                                </div>
                                <div class="meta-item">
                                    👥 {{ $event->registrations->count() }} / {{ $event->max_participants }} registered
                                </div>
                            </div>
                            <p class="event-description">{{ $event->description }}</p>
                            
                            <div class="event-actions">
                                <a href="{{ route('events.show', $event) }}" class="btn btn-small">
                                    View Details
                                </a>
                                
                                @if(auth()->user()->role === 'organizer' || auth()->user()->role === 'admin')
                                    @if($event->organizer_id === auth()->id() || auth()->user()->role === 'admin')
                                        <a href="{{ route('organizer.events.edit', $event) }}" class="btn btn-small btn-secondary">
                                            Edit
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($events->hasPages())
                <div class="pagination">
                    @if ($events->onFirstPage())
                        <span style="opacity: 0.5;">← Previous</span>
                    @else
                        <a href="{{ $events->previousPageUrl() }}">← Previous</a>
                    @endif

                    @foreach ($events->getUrlRange(1, $events->lastPage()) as $page => $url)
                        @if ($page == $events->currentPage())
                            <span class="active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if ($events->hasMorePages())
                        <a href="{{ $events->nextPageUrl() }}">Next →</a>
                    @else
                        <span style="opacity: 0.5;">Next →</span>
                    @endif
                </div>
            @endif
        @else
            <div class="no-events">
                <div class="no-events-icon">📅</div>
                <h3>No events available</h3>
                <p>There are no events to display at the moment.</p>
                @if(auth()->user()->role === 'organizer' || auth()->user()->role === 'admin')
                    <a href="{{ route('organizer.events.create') }}" class="btn" style="margin-top: 1rem;">Create First Event</a>
                @endif
            </div>
        @endif
    </div>
</body>
</html>
