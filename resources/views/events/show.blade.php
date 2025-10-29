<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $event->title }} - Event Details</title>
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
            max-width: 900px;
            margin: 0 auto;
        }

        .event-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .event-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 3rem 2rem;
            color: white;
            text-align: center;
        }

        .event-header h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .event-status {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
        }

        .event-content {
            padding: 2rem;
        }

        .event-meta {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .meta-item {
            padding: 1rem;
            background: #f9fafb;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .meta-icon {
            font-size: 2rem;
        }

        .meta-info h3 {
            font-size: 0.85rem;
            color: #666;
            margin-bottom: 0.3rem;
        }

        .meta-info p {
            font-size: 1.1rem;
            color: #333;
            font-weight: 600;
        }

        .event-description {
            margin: 2rem 0;
        }

        .event-description h2 {
            color: #333;
            margin-bottom: 1rem;
        }

        .event-description p {
            color: #666;
            line-height: 1.8;
            font-size: 1.05rem;
        }

        .participants-section {
            margin: 2rem 0;
            padding: 1.5rem;
            background: #f9fafb;
            border-radius: 10px;
        }

        .participants-section h3 {
            color: #333;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .progress-bar {
            width: 100%;
            height: 10px;
            background: #e0e0e0;
            border-radius: 5px;
            overflow: hidden;
            margin-top: 0.5rem;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: width 0.3s;
        }

        .event-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .btn {
            padding: 1rem 2rem;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
        }

        .btn-danger {
            background: #ef4444;
            color: white;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.5);
        }

        .btn-secondary {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-secondary:hover {
            background: #667eea;
            color: white;
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

        .organizer-info {
            margin: 2rem 0;
            padding: 1.5rem;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            border-radius: 10px;
        }

        .organizer-info h3 {
            color: #333;
            margin-bottom: 0.5rem;
        }

        .organizer-info p {
            color: #666;
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .event-header h1 {
                font-size: 1.8rem;
            }

            .event-content {
                padding: 1.5rem;
            }

            .event-meta {
                grid-template-columns: 1fr;
            }

            .event-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="event-card">
            <div class="event-header">
                <span class="event-status">{{ $event->status }}</span>
                <h1>{{ $event->title }}</h1>
            </div>

            <div class="event-content">
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

                <div class="event-meta">
                    <div class="meta-item">
                        <div class="meta-icon">📅</div>
                        <div class="meta-info">
                            <h3>Date & Time</h3>
                            <p>{{ $event->event_date->format('M d, Y') }}</p>
                            <p style="font-size: 0.9rem; color: #999;">{{ $event->event_date->format('h:i A') }}</p>
                        </div>
                    </div>

                    <div class="meta-item">
                        <div class="meta-icon">📍</div>
                        <div class="meta-info">
                            <h3>Location</h3>
                            <p>{{ $event->location }}</p>
                        </div>
                    </div>

                    <div class="meta-item">
                        <div class="meta-icon">👥</div>
                        <div class="meta-info">
                            <h3>Participants</h3>
                            <p>{{ $event->registrations->count() }} / {{ $event->max_participants }}</p>
                        </div>
                    </div>
                </div>

                <div class="participants-section">
                    <h3>📊 Registration Progress</h3>
                    @php
                        $percentage = ($event->registrations->count() / $event->max_participants) * 100;
                    @endphp
                    <p style="color: #666; margin-bottom: 0.5rem;">
                        {{ number_format($percentage, 1) }}% Full
                    </p>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $percentage }}%"></div>
                    </div>
                </div>

                <div class="event-description">
                    <h2>📋 About This Event</h2>
                    <p>{{ $event->description }}</p>
                </div>

                <div class="organizer-info">
                    <h3>👤 Organized By</h3>
                    <p>{{ $event->organizer->name }}</p>
                </div>

                <div class="event-actions">
                    @php
                        $isRegistered = $event->registrations->where('user_id', auth()->id())->first();
                        $isFull = $event->registrations->count() >= $event->max_participants;
                        $isPast = $event->event_date < now();
                    @endphp

                    @if($isRegistered)
                        <form action="{{ route('events.unregister', $event) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel your registration?')">
                                ✗ Cancel Registration
                            </button>
                        </form>
                    @elseif($isPast)
                        <button class="btn btn-secondary" disabled>
                            Event Ended
                        </button>
                    @elseif($event->status !== 'active')
                        <button class="btn btn-secondary" disabled>
                            Registration Closed
                        </button>
                    @elseif($isFull)
                        <button class="btn btn-secondary" disabled>
                            Event Full
                        </button>
                    @else
                        <form action="{{ route('events.register', $event) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                ✓ Register for Event
                            </button>
                        </form>
                    @endif

                    <a href="{{ route('events.index') }}" class="btn btn-secondary">
                        ← Back to Events
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
