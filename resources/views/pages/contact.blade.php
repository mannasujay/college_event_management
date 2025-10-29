@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<style>
    .contact-page {
        min-height: 100vh;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 4rem 0;
    }

    .contact-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .contact-header {
        text-align: center;
        margin-bottom: 4rem;
        animation: fadeInDown 0.8s ease;
    }

    .contact-header h1 {
        font-size: 3.5rem;
        color: white;
        margin-bottom: 1rem;
        font-weight: 700;
    }

    .contact-header p {
        font-size: 1.3rem;
        color: rgba(255, 255, 255, 0.9);
        max-width: 700px;
        margin: 0 auto;
    }

    .contact-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        animation: fadeInUp 0.8s ease;
    }

    .contact-form-card {
        background: white;
        border-radius: 20px;
        padding: 3rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .contact-form-card h2 {
        font-size: 2rem;
        color: #333;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #333;
    }

    .form-control {
        width: 100%;
        padding: 0.8rem 1rem;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s;
        font-family: inherit;
    }

    .form-control:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    textarea.form-control {
        min-height: 150px;
        resize: vertical;
    }

    .btn-submit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1rem 2rem;
        border: none;
        border-radius: 10px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        width: 100%;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .contact-info-card {
        background: white;
        border-radius: 20px;
        padding: 3rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .contact-info-card h2 {
        font-size: 2rem;
        color: #333;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-item {
        display: flex;
        align-items: start;
        gap: 1rem;
        margin-bottom: 2rem;
        padding: 1.5rem;
        background: #f7fafc;
        border-radius: 15px;
        transition: all 0.3s;
    }

    .info-item:hover {
        background: #edf2f7;
        transform: translateX(5px);
    }

    .info-icon {
        font-size: 2rem;
        min-width: 40px;
    }

    .info-content h3 {
        font-size: 1.2rem;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .info-content p {
        color: #666;
        font-size: 1rem;
        line-height: 1.6;
    }

    .info-content a {
        color: #667eea;
        text-decoration: none;
        transition: all 0.3s;
    }

    .info-content a:hover {
        color: #764ba2;
    }

    .social-links {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }

    .social-link {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        text-decoration: none;
        transition: all 0.3s;
    }

    .social-link:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
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

    @media (max-width: 968px) {
        .contact-content {
            grid-template-columns: 1fr;
        }

        .contact-header h1 {
            font-size: 2.5rem;
        }
    }
</style>

<div class="contact-page">
    <div class="contact-container">
        <div class="contact-header">
            <h1>📧 Contact Us</h1>
            <p>Have questions? We'd love to hear from you. Send us a message!</p>
        </div>

        <div class="contact-content">
            <div class="contact-form-card">
                <h2>💬 Send Message</h2>
                
                @if(session('success'))
                    <div style="background: #d1fae5; color: #065f46; padding: 1rem 1.5rem; border-radius: 10px; margin-bottom: 1.5rem; border-left: 4px solid #10b981;">
                        ✓ {{ session('success') }}
                    </div>
                @endif
                
                <form method="POST" action="{{ route('contact.submit') }}">
                    @csrf
                    
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            class="form-control" 
                            placeholder="Enter your name"
                            required
                        >
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="form-control" 
                            placeholder="your.email@example.com"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input 
                            type="text" 
                            id="subject" 
                            name="subject" 
                            class="form-control" 
                            placeholder="What is this about?"
                            required
                        >
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea 
                            id="message" 
                            name="message" 
                            class="form-control" 
                            placeholder="Tell us what's on your mind..."
                            required
                        ></textarea>
                    </div>
                    
                    <button type="submit" class="btn-submit">✉️ Send Message</button>
                </form>
            </div>

            <div class="contact-info-card">
                <h2>📍 Contact Information</h2>

                <div class="info-item">
                    <div class="info-icon">📧</div>
                    <div class="info-content">
                        <h3>Email</h3>
                        <p><a href="mailto:support@collegeevent.com">support@collegeevent.com</a></p>
                        <p><a href="mailto:info@collegeevent.com">info@collegeevent.com</a></p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">📞</div>
                    <div class="info-content">
                        <h3>Phone</h3>
                        <p><a href="tel:+1234567890">+1 (234) 567-890</a></p>
                        <p>Mon-Fri, 9:00 AM - 6:00 PM</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">🏢</div>
                    <div class="info-content">
                        <h3>Office</h3>
                        <p>123 College Street<br>University Campus<br>City, State 12345</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">⏰</div>
                    <div class="info-content">
                        <h3>Business Hours</h3>
                        <p>Monday - Friday: 9:00 AM - 6:00 PM<br>
                        Saturday: 10:00 AM - 4:00 PM<br>
                        Sunday: Closed</p>
                    </div>
                </div>

                <h3 style="margin-top: 2rem; margin-bottom: 1rem; color: #333;">🌐 Follow Us</h3>
                <div class="social-links">
                    <a href="#" class="social-link" title="Facebook">📘</a>
                    <a href="#" class="social-link" title="Twitter">🐦</a>
                    <a href="#" class="social-link" title="Instagram">📷</a>
                    <a href="#" class="social-link" title="LinkedIn">💼</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
