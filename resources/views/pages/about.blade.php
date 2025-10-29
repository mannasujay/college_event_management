@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<style>
    .about-page {
        min-height: 100vh;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 4rem 0;
    }

    .about-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .about-header {
        text-align: center;
        margin-bottom: 4rem;
        animation: fadeInDown 0.8s ease;
    }

    .about-header h1 {
        font-size: 3.5rem;
        color: white;
        margin-bottom: 1rem;
        font-weight: 700;
    }

    .about-header p {
        font-size: 1.3rem;
        color: rgba(255, 255, 255, 0.9);
        max-width: 700px;
        margin: 0 auto;
    }

    .about-content {
        display: grid;
        gap: 2rem;
        margin-bottom: 4rem;
    }

    .content-card {
        background: white;
        border-radius: 20px;
        padding: 3rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        animation: fadeInUp 0.8s ease;
    }

    .content-card h2 {
        font-size: 2rem;
        color: #333;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .content-card p {
        font-size: 1.1rem;
        color: #666;
        line-height: 1.8;
        margin-bottom: 1rem;
    }

    .mission-vision {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-bottom: 4rem;
    }

    .mission-card, .vision-card {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        animation: fadeInUp 0.8s ease;
        text-align: center;
    }

    .mission-card {
        animation-delay: 0.2s;
    }

    .vision-card {
        animation-delay: 0.4s;
    }

    .mission-card h3, .vision-card h3 {
        font-size: 1.8rem;
        color: #333;
        margin-bottom: 1rem;
    }

    .mission-icon, .vision-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        margin-bottom: 4rem;
    }

    .feature-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        transition: all 0.3s;
        animation: fadeInUp 0.8s ease;
    }

    .feature-card:nth-child(1) { animation-delay: 0.1s; }
    .feature-card:nth-child(2) { animation-delay: 0.2s; }
    .feature-card:nth-child(3) { animation-delay: 0.3s; }
    .feature-card:nth-child(4) { animation-delay: 0.4s; }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
    }

    .feature-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    .feature-card h4 {
        font-size: 1.3rem;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .feature-card p {
        color: #666;
        font-size: 1rem;
    }

    .team-section {
        text-align: center;
        margin-bottom: 2rem;
    }

    .team-section h2 {
        font-size: 2.5rem;
        color: white;
        margin-bottom: 3rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 2rem;
        margin-top: 4rem;
    }

    .stat-box {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        border: 2px solid rgba(255, 255, 255, 0.2);
        animation: fadeInUp 0.8s ease;
    }

    .stat-box:nth-child(1) { animation-delay: 0.1s; }
    .stat-box:nth-child(2) { animation-delay: 0.2s; }
    .stat-box:nth-child(3) { animation-delay: 0.3s; }
    .stat-box:nth-child(4) { animation-delay: 0.4s; }

    .stat-number {
        font-size: 3rem;
        font-weight: 700;
        color: white;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.9);
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

    @media (max-width: 768px) {
        .about-header h1 {
            font-size: 2.5rem;
        }

        .content-card {
            padding: 2rem;
        }

        .features-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="about-page">
    <div class="about-container">
        <div class="about-header">
            <h1>🎓 About Us</h1>
            <p>Empowering students and organizers to create amazing event experiences</p>
        </div>

        <div class="about-content">
            <div class="content-card">
                <h2>📖 Our Story</h2>
                <p>
                    College Event Management System was born from the vision of making event organization 
                    seamless and accessible for educational institutions. We understand the challenges faced 
                    by students and organizers in coordinating events, managing registrations, and maintaining 
                    effective communication.
                </p>
                <p>
                    Our platform bridges the gap between event organizers and participants, providing a 
                    comprehensive solution that simplifies every aspect of event management—from creation 
                    and promotion to registration and feedback collection.
                </p>
            </div>
        </div>

        <div class="mission-vision">
            <div class="mission-card">
                <div class="mission-icon">🎯</div>
                <h3>Our Mission</h3>
                <p>
                    To provide an intuitive, efficient, and reliable platform that transforms how 
                    educational events are organized and experienced, fostering greater engagement 
                    and participation within the college community.
                </p>
            </div>

            <div class="vision-card">
                <div class="vision-icon">🌟</div>
                <h3>Our Vision</h3>
                <p>
                    To become the leading event management solution for educational institutions 
                    worldwide, creating vibrant campus communities through seamless event experiences 
                    and meaningful connections.
                </p>
            </div>
        </div>

        <div class="team-section">
            <h2>✨ What We Offer</h2>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">📅</div>
                <h4>Event Management</h4>
                <p>Create, edit, and manage events with ease. Set dates, capacities, and track registrations in real-time.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">👥</div>
                <h4>User Roles</h4>
                <p>Distinct roles for admins, organizers, and students with tailored dashboards and permissions.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <h4>Analytics</h4>
                <p>Comprehensive insights and statistics to help you make data-driven decisions.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">📢</div>
                <h4>Announcements</h4>
                <p>Keep everyone informed with priority-based announcement system for important updates.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">💬</div>
                <h4>Feedback System</h4>
                <p>Collect valuable feedback from participants to continuously improve event quality.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">🔒</div>
                <h4>Secure Platform</h4>
                <p>Built with security in mind, protecting user data and ensuring reliable operations.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">📱</div>
                <h4>Responsive Design</h4>
                <p>Access the platform from any device—desktop, tablet, or mobile phone.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">⚡</div>
                <h4>Real-time Updates</h4>
                <p>Live updates on event registrations, capacity, and announcements.</p>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-box">
                <div class="stat-number">{{ \App\Models\Event::count() }}+</div>
                <div class="stat-label">Events Organized</div>
            </div>

            <div class="stat-box">
                <div class="stat-number">{{ \App\Models\User::count() }}+</div>
                <div class="stat-label">Active Users</div>
            </div>

            <div class="stat-box">
                <div class="stat-number">{{ \App\Models\Registration::count() }}+</div>
                <div class="stat-label">Registrations</div>
            </div>

            <div class="stat-box">
                <div class="stat-number">100%</div>
                <div class="stat-label">Satisfaction</div>
            </div>
        </div>
    </div>
</div>
@endsection
