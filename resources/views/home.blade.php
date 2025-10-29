<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'College Event Management') }} - Home</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Figtree', sans-serif;
            line-height: 1.6;
            color: #333;
            overflow-x: hidden;
        }
        
        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }
        
        /* Remove home-specific navbar styles - using global navbar from style.css */
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: width 0.3s;
        }
        
        .nav-links a:not(.btn):hover::after {
            width: 100%;
        }
        
        .btn {
            padding: 0.6rem 1.5rem;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-block;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }
        
        .btn-secondary {
            background: transparent;
            color: white;
            border: 2px solid white;
        }
        
        .btn-secondary:hover {
            background: white;
            color: #667eea;
        }
        
        .btn-outline {
            background: transparent;
            color: #667eea;
            border: 2px solid #667eea;
        }
        
        .btn-outline:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: transparent;
        }
        
        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 8rem 2rem 6rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M 100 0 L 0 0 0 100" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grid)"/></svg>');
            opacity: 0.5;
        }
        
        .hero::after {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            border-radius: 50%;
            top: -200px;
            right: -200px;
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(-20px, 20px) rotate(180deg); }
        }
        
        .hero-container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }
        
        .hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            animation: fadeInUp 0.8s ease-out;
            line-height: 1.2;
            text-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }
        
        .hero h1 .highlight {
            background: linear-gradient(to right, #fff, #e0e7ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hero p {
            font-size: 1.4rem;
            margin-bottom: 2.5rem;
            opacity: 0.95;
            animation: fadeInUp 1s ease-out;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeInUp 1.2s ease-out;
        }
        
        /* Features Section */
        .features {
            padding: 5rem 2rem;
            background: #f8f9fa;
        }
        
        .features-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 3rem;
            color: #333;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .feature-card {
            background: white;
            padding: 2.5rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid #f0f0f0;
            position: relative;
            overflow: hidden;
        }
        
        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transform: scaleX(0);
            transition: transform 0.3s;
        }
        
        .feature-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 12px 40px rgba(102, 126, 234, 0.2);
        }
        
        .feature-card:hover::before {
            transform: scaleX(1);
        }
        
        .feature-icon {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            display: inline-block;
            animation: bounce 2s ease-in-out infinite;
        }
        
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        .feature-card:hover .feature-icon {
            animation: none;
            transform: scale(1.1) rotate(5deg);
            transition: transform 0.3s;
        }
        
        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #667eea;
        }
        
        .feature-card p {
            color: #666;
            line-height: 1.8;
        }
        
        /* Stats Section */
        .stats {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 5rem 2rem;
            position: relative;
            overflow: hidden;
        }
        
        .stats::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            border-radius: 50%;
            bottom: -200px;
            left: -200px;
        }
        
        .stats-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 3rem;
            text-align: center;
            position: relative;
            z-index: 1;
        }
        
        .stat-item {
            padding: 1.5rem;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            transition: all 0.3s;
        }
        
        .stat-item:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-5px);
        }
        
        .stat-item h2 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            animation: countUp 2s ease-out;
        }
        
        @keyframes countUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .stat-item p {
            font-size: 1.1rem;
            opacity: 0.95;
            font-weight: 500;
        }
        
        /* Footer */
        .footer {
            background: #1a202c;
            color: white;
            padding: 3rem 2rem;
            text-align: center;
        }
        
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .footer p {
            opacity: 0.8;
            font-size: 0.95rem;
        }
        
        .footer-links {
            margin-top: 1rem;
            display: flex;
            gap: 2rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .footer-links a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: color 0.3s;
            font-size: 0.9rem;
        }
        
        .footer-links a:hover {
            color: #667eea;
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
        
        /* Responsive */
        /* Scroll indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            animation: bounce-vertical 2s ease-in-out infinite;
            z-index: 1;
        }
        
        @keyframes bounce-vertical {
            0%, 100% { transform: translateX(-50%) translateY(0); }
            50% { transform: translateX(-50%) translateY(10px); }
        }
        
        .scroll-indicator span {
            display: block;
            width: 30px;
            height: 50px;
            border: 2px solid rgba(255,255,255,0.5);
            border-radius: 25px;
            position: relative;
        }
        
        .scroll-indicator span::before {
            content: '';
            position: absolute;
            top: 8px;
            left: 50%;
            transform: translateX(-50%);
            width: 6px;
            height: 6px;
            background: white;
            border-radius: 50%;
            animation: scroll-wheel 2s ease-in-out infinite;
        }
        
        @keyframes scroll-wheel {
            0% { top: 8px; opacity: 1; }
            100% { top: 24px; opacity: 0; }
        }
        
        @media (max-width: 768px) {
            .hero {
                padding: 5rem 2rem 4rem;
            }
            
            .hero h1 {
                font-size: 2.2rem;
            }
            
            .hero p {
                font-size: 1.1rem;
            }
            
            .nav-links {
                gap: 1rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .stats-container {
                gap: 2rem;
            }
            
            .stat-item h2 {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    @include('components.navbar')

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-container">
            <h1>
                Welcome to <span class="highlight">College Event</span><br>
                Management System
            </h1>
            <p>Discover, Register, and Participate in Amazing College Events. Your Gateway to Campus Life!</p>
            <div class="hero-buttons">
                @guest
                    <a href="{{ route('register') }}" class="btn btn-primary">Get Started Free</a>
                    <a href="{{ route('login') }}" class="btn btn-secondary">Sign In</a>
                @else
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
                @endguest
            </div>
        </div>
        <div class="scroll-indicator">
            <span></span>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="features-container">
            <h2 class="section-title">Why Choose Our Platform?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">📅</div>
                    <h3>Event Management</h3>
                    <p>Easily browse and discover upcoming college events. Stay updated with the latest happenings on campus.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">✅</div>
                    <h3>Quick Registration</h3>
                    <p>Register for events with just a few clicks. Simple and hassle-free registration process.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📢</div>
                    <h3>Announcements</h3>
                    <p>Receive important updates and announcements about events directly to your dashboard.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🏆</div>
                    <h3>Results & Feedback</h3>
                    <p>View event results and provide feedback to help us improve future events.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">👥</div>
                    <h3>Role-Based Access</h3>
                    <p>Different access levels for students, organizers, and administrators.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h3>Analytics Dashboard</h3>
                    <p>Track participation, view statistics, and monitor event performance.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="stats-container">
            <div class="stat-item">
                <h2>{{ $totalEvents }}+</h2>
                <p>Events Organized</p>
            </div>
            <div class="stat-item">
                <h2>{{ $totalStudents }}+</h2>
                <p>Students Registered</p>
            </div>
            <div class="stat-item">
                <h2>{{ $totalRegistrations }}+</h2>
                <p>Total Participations</p>
            </div>
            <div class="stat-item">
                <h2>24/7</h2>
                <p>Support Available</p>
            </div>
        </div>
    </section>

    <!-- Upcoming Events Section -->
    @if($upcomingEvents->count() > 0)
    <section class="features">
        <div class="features-container">
            <h2 style="text-align: center; font-size: 2.5rem; margin-bottom: 3rem; color: white;">
                🎉 Upcoming Events
            </h2>
            <div class="features-grid">
                @foreach($upcomingEvents as $event)
                    <div class="feature-card" style="text-align: left;">
                        <div class="feature-icon">📅</div>
                        <h3>{{ $event->title }}</h3>
                        <p style="margin: 0.5rem 0; color: #ddd;">
                            📍 {{ $event->location }}<br>
                            🕐 {{ $event->event_date->format('M d, Y - h:i A') }}<br>
                            👥 {{ $event->registrations->count() }}/{{ $event->max_participants }} registered
                        </p>
                        <p style="margin-top: 1rem;">{{ Str::limit($event->description, 100) }}</p>
                        @auth
                            <a href="{{ route('events.show', $event) }}" class="btn btn-outline" style="margin-top: 1rem;">
                                View Details
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline" style="margin-top: 1rem;">
                                Login to Register
                            </a>
                        @endauth
                    </div>
                @endforeach
            </div>
            @auth
                <div style="text-align: center; margin-top: 2rem;">
                    <a href="{{ route('events.index') }}" class="btn btn-primary" style="font-size: 1.1rem; padding: 1rem 2rem;">
                        View All Events →
                    </a>
                </div>
            @endauth
        </div>
    </section>
    @endif

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <p>&copy; {{ date('Y') }} College Event Management System. All rights reserved.</p>
            <div class="footer-links">
                <a href="#">About Us</a>
                <a href="#">Contact</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scroll for internal links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>
