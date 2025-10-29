<div>
    <style>
        .event-list-component {
            padding: 1rem;
        }

        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
            margin-top: 1rem;
        }

        .event-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .event-header {
            margin-bottom: 1rem;
        }

        .event-header h3 {
            font-size: 1.3rem;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .event-date {
            display: inline-block;
            font-size: 0.9rem;
            color: #667eea;
            font-weight: 500;
        }

        .event-description {
            color: #666;
            line-height: 1.6;
            margin-bottom: 1rem;
            flex-grow: 1;
        }

        .event-details {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding-top: 1rem;
            border-top: 1px solid #eee;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            color: #666;
        }

        .detail-item .icon {
            font-size: 1rem;
        }

        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            text-align: center;
            font-weight: 500;
            transition: transform 0.2s;
        }

        .btn-register:hover {
            transform: scale(1.02);
        }

        .no-events {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .empty-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
        }

        .no-events h3 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .no-events p {
            color: #666;
        }
    </style>

    <div class="event-list-component">
        @if($events->count() > 0)
            <div class="events-grid">
                @foreach($events as $event)
                    <div class="event-card">
                        <div class="event-header">
                            <h3>{{ $event->name }}</h3>
                            <span class="event-date">
                                📅 {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                            </span>
                        </div>
                        
                        <p class="event-description">{{ Str::limit($event->description, 100) }}</p>
                        
                        <div class="event-details">
                            <div class="detail-item">
                                <span class="icon">📍</span>
                                <span>{{ $event->location }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="icon">👥</span>
                                <span>{{ $event->max_participants }} slots</span>
                            </div>
                        </div>
                        
                        <a href="{{ route('student.register-event', $event->id) }}" class="btn-register">
                            Register Now
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-events">
                <div class="empty-icon">📅</div>
                <h3>No Events Available</h3>
                <p>Check back later for upcoming events!</p>
            </div>
        @endif
    </div>
</div>
