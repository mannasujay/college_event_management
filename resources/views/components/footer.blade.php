<style>
    .site-footer {
        background: linear-gradient(135deg, #2d3748 0%, #1a202c 100%);
        color: white;
        padding: 3rem 0 1rem 0;
        margin-top: 4rem;
    }

    .footer-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 3rem;
        margin-bottom: 2rem;
    }

    .footer-section h3 {
        font-size: 1.3rem;
        margin-bottom: 1rem;
        color: #fff;
        font-weight: 600;
    }

    .footer-section p {
        color: rgba(255, 255, 255, 0.7);
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 0.8rem;
    }

    .footer-links a {
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .footer-links a:hover {
        color: #fff;
        transform: translateX(5px);
    }

    .footer-social {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }

    .social-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        transition: all 0.3s;
        font-size: 1.2rem;
    }

    .social-icon:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        transform: translateY(-3px);
    }

    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding-top: 2rem;
        text-align: center;
        color: rgba(255, 255, 255, 0.6);
    }

    .footer-bottom p {
        margin: 0.5rem 0;
    }

    .footer-bottom a {
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        transition: all 0.3s;
    }

    .footer-bottom a:hover {
        color: #fff;
    }

    @media (max-width: 768px) {
        .footer-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }
    }
</style>

<footer class="site-footer">
    <div class="footer-content">
        <div class="footer-grid">
            <div class="footer-section">
                <h3>🎓 College Events</h3>
                <p>
                    Your comprehensive platform for managing college events. 
                    Simplifying event organization and participation for students and organizers.
                </p>
                <div class="footer-social">
                    <a href="#" class="social-icon" title="Facebook">📘</a>
                    <a href="#" class="social-icon" title="Twitter">🐦</a>
                    <a href="#" class="social-icon" title="Instagram">📷</a>
                    <a href="#" class="social-icon" title="LinkedIn">💼</a>
                </div>
            </div>

            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">🏠 Home</a></li>
                    <li><a href="{{ route('events.index') }}">📅 Events</a></li>
                    <li><a href="{{ route('about') }}">ℹ️ About Us</a></li>
                    <li><a href="{{ route('contact') }}">📧 Contact</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Legal</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('privacy') }}">🔒 Privacy Policy</a></li>
                    <li><a href="{{ route('terms') }}">📜 Terms of Service</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Contact Info</h3>
                <ul class="footer-links">
                    <li>
                        <a href="mailto:support@collegeevent.com">
                            📧 support@collegeevent.com
                        </a>
                    </li>
                    <li>
                        <a href="tel:+1234567890">
                            📞 +1 (234) 567-890
                        </a>
                    </li>
                    <li>
                        🏢 123 College Street<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;University Campus<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;City, State 12345
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} College Event Management System. All rights reserved.</p>
            <p>
                Made with ❤️ for educational institutions | 
                <a href="{{ route('privacy') }}">Privacy</a> • 
                <a href="{{ route('terms') }}">Terms</a>
            </p>
        </div>
    </div>
</footer>
