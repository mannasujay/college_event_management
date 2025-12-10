<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'College Event Management') }} - Professional Event Platform</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link href="{{ asset('css/professional-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    @include('components.navbar')

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <div class="hero-badge">
                        <span class="badge badge-primary">
                            🎉 New Events Added Weekly
                        </span>
                    </div>
                    <h1 class="hero-title">
                        Discover & Join
                        <span class="hero-gradient-text">Amazing College Events</span>
                    </h1>
                    <p class="hero-description">
                        Connect with your campus community through exciting events, workshops, and activities. 
                        Build memories, gain knowledge, and grow your network.
                    </p>
                    <div class="hero-actions">
                        @guest
                            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                                Get Started Free
                            </a>
                            <a href="{{ route('events.index') }}" class="btn btn-outline btn-lg">
                                Browse Events
                            </a>
                        @else
                            <a href="{{ route('student.dashboard') }}" class="btn btn-primary btn-lg">
                                Go to Dashboard
                            </a>
                            <a href="{{ route('student.event-list') }}" class="btn btn-outline btn-lg">
                                View Events
                            </a>
                        @endguest
                    </div>
                    
                    <!-- Stats -->
                    <div class="hero-stats">
                        <div class="stat-item">
                            <div class="stat-number">{{ $totalEvents }}+</div>
                            <div class="stat-label">Total Events</div>
                        </div>
                        <div class="stat-divider"></div>
                        <div class="stat-item">
                            <div class="stat-number">{{ $totalStudents }}+</div>
                            <div class="stat-label">Active Students</div>
                        </div>
                        <div class="stat-divider"></div>
                        <div class="stat-item">
                            <div class="stat-number">{{ $totalRegistrations }}+</div>
                            <div class="stat-label">Registrations</div>
                        </div>
                    </div>
                </div>
                
                <div class="hero-visual">
                    <div class="hero-image-wrapper">
                        <div class="floating-card floating-card-1">
                            <span class="card-icon">📚</span>
                            <span class="card-text">Workshops</span>
                        </div>
                        <div class="floating-card floating-card-2">
                            <span class="card-icon">🎭</span>
                            <span class="card-text">Cultural</span>
                        </div>
                        <div class="floating-card floating-card-3">
                            <span class="card-icon">🏆</span>
                            <span class="card-text">Competitions</span>
                        </div>
                        <div class="hero-main-card">
                            <div class="main-card-header">
                                <span class="main-card-icon">🎓</span>
                                <span class="main-card-title">College Events</span>
                            </div>
                            <div class="main-card-body">
                                <div class="main-card-item">
                                    <span class="item-icon">✓</span>
                                    <span>Easy Registration</span>
                                </div>
                                <div class="main-card-item">
                                    <span class="item-icon">✓</span>
                                    <span>Digital Certificates</span>
                                </div>
                                <div class="main-card-item">
                                    <span class="item-icon">✓</span>
                                    <span>Event Reminders</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Decorative Elements -->
        <div class="hero-decoration decoration-1"></div>
        <div class="hero-decoration decoration-2"></div>
        <div class="hero-decoration decoration-3"></div>
    </section>

    <!-- Features Section -->
    <section class="features-section section-lg">
        <div class="container">
            <div class="section-header text-center">
                <div class="section-badge">
                    <span class="badge badge-primary">Features</span>
                </div>
                <h2 class="section-title">Everything You Need to Manage Events</h2>
                <p class="section-description">
                    A comprehensive platform designed to make event management seamless and enjoyable
                </p>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon feature-icon-blue">
                        📅
                    </div>
                    <h3 class="feature-title">Easy Registration</h3>
                    <p class="feature-description">
                        Register for events with just a few clicks. No complicated forms or processes.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon feature-icon-purple">
                        🎫
                    </div>
                    <h3 class="feature-title">Digital Certificates</h3>
                    <p class="feature-description">
                        Receive beautiful digital certificates instantly after event completion.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon feature-icon-green">
                        📊
                    </div>
                    <h3 class="feature-title">Event Analytics</h3>
                    <p class="feature-description">
                        Organizers get detailed insights and analytics for better event planning.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon feature-icon-orange">
                        📸
                    </div>
                    <h3 class="feature-title">Photo Gallery</h3>
                    <p class="feature-description">
                        Access event photos and relive memorable moments through our gallery.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon feature-icon-red">
                        💬
                    </div>
                    <h3 class="feature-title">Feedback System</h3>
                    <p class="feature-description">
                        Share your experience and help us improve future events.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon feature-icon-indigo">
                        🔔
                    </div>
                    <h3 class="feature-title">Smart Notifications</h3>
                    <p class="feature-description">
                        Get timely reminders and updates about your registered events.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Upcoming Events Section -->
    @if($upcomingEvents->count() > 0)
    <section class="events-section section">
        <div class="container">
            <div class="section-header">
                <div class="section-title-wrapper">
                    <div class="section-badge">
                        <span class="badge badge-primary">Upcoming</span>
                    </div>
                    <h2 class="section-title">Featured Events</h2>
                    <p class="section-description">
                        Don't miss out on these exciting upcoming events
                    </p>
                </div>
                <a href="{{ route('events.index') }}" class="btn btn-outline">
                    View All Events →
                </a>
            </div>

            <div class="events-grid">
                @foreach($upcomingEvents as $event)
                <div class="event-card">
                    @if($event->banner_image)
                    <div class="event-image">
                        <img src="{{ Storage::url($event->banner_image) }}" alt="{{ $event->title }}">
                        <div class="event-badge">
                            <span class="badge badge-success">{{ $event->status }}</span>
                        </div>
                    </div>
                    @else
                    <div class="event-image event-image-placeholder">
                        <div class="placeholder-icon">🎉</div>
                        <div class="event-badge">
                            <span class="badge badge-success">{{ $event->status }}</span>
                        </div>
                    </div>
                    @endif
                    
                    <div class="event-content">
                        <h3 class="event-title">{{ $event->title }}</h3>
                        <p class="event-description">
                            {{ Str::limit($event->description, 100) }}
                        </p>
                        
                        <div class="event-meta">
                            <div class="event-meta-item">
                                <span class="meta-icon">📅</span>
                                <span class="meta-text">{{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}</span>
                            </div>
                            <div class="event-meta-item">
                                <span class="meta-icon">⏰</span>
                                <span class="meta-text">{{ \Carbon\Carbon::parse($event->event_time)->format('h:i A') }}</span>
                            </div>
                            <div class="event-meta-item">
                                <span class="meta-icon">📍</span>
                                <span class="meta-text">{{ Str::limit($event->location ?? $event->venue, 20) }}</span>
                            </div>
                        </div>

                        <div class="event-footer">
                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <div class="cta-text">
                    <h2 class="cta-title">Ready to Get Started?</h2>
                    <p class="cta-description">
                        Join thousands of students already using our platform to discover and participate in amazing events.
                    </p>
                </div>
                <div class="cta-actions">
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                            Create Account
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-ghost btn-lg">
                            Sign In
                        </a>
                    @else
                        <a href="{{ route('student.event-list') }}" class="btn btn-primary btn-lg">
                            Browse Events
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </section>

    @include('components.footer')

    <style>
        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-600) 0%, var(--secondary-600) 100%);
            padding: var(--space-20) 0 var(--space-16);
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: var(--space-12);
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .hero-badge {
            margin-bottom: var(--space-6);
            animation: fadeInDown 0.6s ease-out;
        }

        .hero-title {
            font-size: var(--text-5xl);
            font-weight: var(--font-extrabold);
            color: var(--text-white);
            line-height: 1.1;
            margin-bottom: var(--space-6);
            animation: fadeInUp 0.6s ease-out 0.2s both;
        }

        .hero-gradient-text {
            background: linear-gradient(135deg, #fff 0%, #e0e7ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: block;
        }

        .hero-description {
            font-size: var(--text-xl);
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.6;
            margin-bottom: var(--space-8);
            animation: fadeInUp 0.6s ease-out 0.4s both;
        }

        .hero-actions {
            display: flex;
            gap: var(--space-4);
            flex-wrap: wrap;
            animation: fadeInUp 0.6s ease-out 0.6s both;
        }

        .hero-stats {
            display: flex;
            gap: var(--space-8);
            margin-top: var(--space-12);
            padding-top: var(--space-8);
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeInUp 0.6s ease-out 0.8s both;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: var(--text-4xl);
            font-weight: var(--font-extrabold);
            color: var(--text-white);
            display: block;
        }

        .stat-label {
            font-size: var(--text-sm);
            color: rgba(255, 255, 255, 0.8);
            margin-top: var(--space-1);
        }

        .stat-divider {
            width: 1px;
            background: rgba(255, 255, 255, 0.2);
        }

        /* Hero Visual */
        .hero-visual {
            position: relative;
            height: 500px;
            animation: fadeIn 0.8s ease-out 0.6s both;
        }

        .hero-image-wrapper {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .floating-card {
            position: absolute;
            background: var(--bg-primary);
            padding: var(--space-3) var(--space-4);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-2xl);
            display: flex;
            align-items: center;
            gap: var(--space-2);
            font-weight: var(--font-semibold);
            animation: float 3s ease-in-out infinite;
        }

        .floating-card-1 {
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-card-2 {
            top: 60%;
            left: 5%;
            animation-delay: 1s;
        }

        .floating-card-3 {
            top: 10%;
            right: 10%;
            animation-delay: 0.5s;
        }

        .card-icon {
            font-size: var(--text-2xl);
        }

        .hero-main-card {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: var(--bg-primary);
            border-radius: var(--radius-2xl);
            padding: var(--space-8);
            box-shadow: var(--shadow-2xl);
            min-width: 300px;
        }

        .main-card-header {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            margin-bottom: var(--space-6);
        }

        .main-card-icon {
            font-size: var(--text-4xl);
        }

        .main-card-title {
            font-size: var(--text-2xl);
            font-weight: var(--font-bold);
            color: var(--text-primary);
        }

        .main-card-item {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            padding: var(--space-3) 0;
            color: var(--text-secondary);
        }

        .item-icon {
            width: 24px;
            height: 24px;
            background: var(--success-100);
            color: var(--success-600);
            border-radius: var(--radius-full);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: var(--text-sm);
        }

        /* Decorations */
        .hero-decoration {
            position: absolute;
            border-radius: var(--radius-full);
            opacity: 0.1;
        }

        .decoration-1 {
            width: 400px;
            height: 400px;
            background: var(--text-white);
            top: -200px;
            right: -100px;
        }

        .decoration-2 {
            width: 300px;
            height: 300px;
            background: var(--text-white);
            bottom: -150px;
            left: -100px;
        }

        .decoration-3 {
            width: 200px;
            height: 200px;
            background: var(--text-white);
            top: 50%;
            left: 50%;
        }

        /* Features Section */
        .features-section {
            background: var(--bg-secondary);
        }

        .section-header {
            text-align: center;
            margin-bottom: var(--space-12);
        }

        .section-title-wrapper {
            margin-bottom: var(--space-8);
        }

        .section-badge {
            margin-bottom: var(--space-4);
        }

        .section-title {
            font-size: var(--text-4xl);
            color: var(--text-primary);
            margin-bottom: var(--space-4);
        }

        .section-description {
            font-size: var(--text-lg);
            color: var(--text-secondary);
            max-width: 600px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: var(--space-6);
        }

        .feature-card {
            background: var(--bg-primary);
            padding: var(--space-8);
            border-radius: var(--radius-2xl);
            text-align: center;
            transition: all var(--transition-base);
            border: 1px solid var(--border-light);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-2xl);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto var(--space-6);
            border-radius: var(--radius-2xl);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: var(--text-4xl);
        }

        .feature-icon-blue { background: var(--primary-50); }
        .feature-icon-purple { background: var(--secondary-50); }
        .feature-icon-green { background: var(--success-50); }
        .feature-icon-orange { background: var(--warning-50); }
        .feature-icon-red { background: var(--danger-50); }
        .feature-icon-indigo { background: var(--primary-100); }

        .feature-title {
            font-size: var(--text-xl);
            margin-bottom: var(--space-3);
            color: var(--text-primary);
        }

        .feature-description {
            color: var(--text-secondary);
            line-height: 1.6;
        }

        /* Events Section */
        .events-section {
            background: var(--bg-primary);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: var(--space-12);
        }

        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: var(--space-8);
        }

        .event-card {
            background: var(--bg-primary);
            border-radius: var(--radius-2xl);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: all var(--transition-base);
            border: 1px solid var(--border-light);
        }

        .event-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-2xl);
        }

        .event-image {
            position: relative;
            height: 220px;
            overflow: hidden;
        }

        .event-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform var(--transition-slow);
        }

        .event-card:hover .event-image img {
            transform: scale(1.05);
        }

        .event-image-placeholder {
            background: linear-gradient(135deg, var(--primary-500), var(--secondary-500));
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .placeholder-icon {
            font-size: 80px;
            opacity: 0.3;
        }

        .event-badge {
            position: absolute;
            top: var(--space-4);
            right: var(--space-4);
        }

        .event-content {
            padding: var(--space-6);
        }

        .event-title {
            font-size: var(--text-xl);
            font-weight: var(--font-semibold);
            color: var(--text-primary);
            margin-bottom: var(--space-3);
        }

        .event-description {
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: var(--space-4);
        }

        .event-meta {
            display: flex;
            flex-direction: column;
            gap: var(--space-2);
            margin-bottom: var(--space-6);
            padding: var(--space-4);
            background: var(--bg-secondary);
            border-radius: var(--radius-lg);
        }

        .event-meta-item {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            font-size: var(--text-sm);
        }

        .meta-icon {
            font-size: var(--text-lg);
        }

        .meta-text {
            color: var(--text-secondary);
        }

        .event-footer {
            display: flex;
            gap: var(--space-3);
        }

        .event-footer .btn {
            flex: 1;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, var(--primary-600), var(--secondary-600));
            padding: var(--space-20) 0;
            position: relative;
            overflow: hidden;
        }

        .cta-content {
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .cta-title {
            font-size: var(--text-5xl);
            font-weight: var(--font-extrabold);
            color: var(--text-white);
            margin-bottom: var(--space-4);
        }

        .cta-description {
            font-size: var(--text-xl);
            color: rgba(255, 255, 255, 0.9);
            max-width: 700px;
            margin: 0 auto var(--space-8);
        }

        .cta-actions {
            display: flex;
            gap: var(--space-4);
            justify-content: center;
            flex-wrap: wrap;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .hero-content {
                grid-template-columns: 1fr;
                gap: var(--space-8);
            }

            .hero-visual {
                height: 400px;
            }

            .section-header {
                flex-direction: column;
                align-items: center;
                gap: var(--space-6);
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: var(--text-4xl);
            }

            .hero-stats {
                flex-direction: column;
                gap: var(--space-4);
            }

            .stat-divider {
                display: none;
            }

            .events-grid {
                grid-template-columns: 1fr;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .cta-title {
                font-size: var(--text-4xl);
            }
        }
    </style>
</body>
</html>
