<nav class="modern-navbar">
    <div class="navbar-container">
        <div class="navbar-brand">
            <a href="{{ url('/') }}" class="brand-link">
                <span class="brand-icon">🎓</span>
                <span class="brand-text">
                    <span class="brand-name">College Events</span>
                    <span class="brand-tagline">Connect & Grow</span>
                </span>
            </a>
        </div>
        
        <button class="mobile-toggle" id="mobileToggle" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <div class="navbar-menu" id="navbarMenu">
            <div class="navbar-links">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <span class="nav-icon">📊</span>
                            <span>Dashboard</span>
                        </a>
                        <a href="{{ route('admin.users') }}" class="nav-link">
                            <span class="nav-icon">👥</span>
                            <span>Users</span>
                        </a>
                        <a href="{{ route('admin.manage-events') }}" class="nav-link">
                            <span class="nav-icon">📅</span>
                            <span>Events</span>
                        </a>
                        <a href="{{ route('admin.announcements') }}" class="nav-link">
                            <span class="nav-icon">📢</span>
                            <span>Announcements</span>
                        </a>
                    @elseif(auth()->user()->role === 'organizer')
                        <a href="{{ route('organizer.dashboard') }}" class="nav-link">
                            <span class="nav-icon">📊</span>
                            <span>Dashboard</span>
                        </a>
                        <a href="{{ route('organizer.events.index') }}" class="nav-link">
                            <span class="nav-icon">📅</span>
                            <span>My Events</span>
                        </a>
                        <a href="{{ route('organizer.events.create') }}" class="nav-link">
                            <span class="nav-icon">➕</span>
                            <span>Create Event</span>
                        </a>
                        <a href="{{ route('organizer.feedbacks') }}" class="nav-link">
                            <span class="nav-icon">💬</span>
                            <span>Feedbacks</span>
                        </a>
                    @else
                        <a href="{{ route('student.dashboard') }}" class="nav-link">
                            <span class="nav-icon">📊</span>
                            <span>Dashboard</span>
                        </a>
                        <a href="{{ route('student.event-list') }}" class="nav-link">
                            <span class="nav-icon">📅</span>
                            <span>Events</span>
                        </a>
                        <a href="{{ route('my-registrations') }}" class="nav-link">
                            <span class="nav-icon">📝</span>
                            <span>Registrations</span>
                        </a>
                        <a href="{{ route('student.feedback') }}" class="nav-link">
                            <span class="nav-icon">💬</span>
                            <span>Feedback</span>
                        </a>
                    @endif

                    <a href="{{ route('home') }}" class="nav-link">
                        <span class="nav-icon">🏠</span>
                        <span>Home</span>
                    </a>
                @else
                    <a href="{{ route('home') }}" class="nav-link">
                        <span class="nav-icon">🏠</span>
                        <span>Home</span>
                    </a>
                    <a href="{{ route('events.index') }}" class="nav-link">
                        <span class="nav-icon">📅</span>
                        <span>Events</span>
                    </a>
                    <a href="{{ route('about') }}" class="nav-link">
                        <span class="nav-icon">ℹ️</span>
                        <span>About</span>
                    </a>
                    <a href="{{ route('contact') }}" class="nav-link">
                        <span class="nav-icon">📧</span>
                        <span>Contact</span>
                    </a>
                @endauth
            </div>

            <div class="navbar-actions">
                @auth
                    <div class="user-menu-wrapper">
                        <button class="user-menu-toggle" id="userMenuToggle">
                            @if(auth()->user()->avatar)
                                <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}" class="user-avatar">
                            @else
                                <div class="user-avatar-placeholder">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                            @endif
                            <span class="user-name">{{ auth()->user()->name }}</span>
                            <svg class="dropdown-arrow" width="12" height="12" viewBox="0 0 12 12">
                                <path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="2" fill="none"/>
                            </svg>
                        </button>
                        <div class="user-dropdown" id="userDropdown">
                            <div class="dropdown-header">
                                <div class="dropdown-user-info">
                                    <div class="dropdown-user-name">{{ auth()->user()->name }}</div>
                                    <div class="dropdown-user-email">{{ auth()->user()->email }}</div>
                                    <div class="dropdown-user-role">{{ ucfirst(auth()->user()->role) }}</div>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                @csrf
                                <button type="submit" class="dropdown-item logout-btn">
                                    <span class="dropdown-icon">🚪</span>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn-login">
                        <span>Login</span>
                    </a>
                    <a href="{{ route('register') }}" class="btn-register">
                        <span>Get Started</span>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<style>
    /* Reset any conflicting styles */
    .modern-navbar * {
        color: inherit;
    }

    .modern-navbar {
        background: rgba(255, 255, 255, 0.98) !important;
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
        position: sticky !important;
        top: 0;
        z-index: 1000;
        border-bottom: 1px solid rgba(102, 126, 234, 0.1);
    }

    .navbar-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 70px;
    }

    .navbar-brand .brand-link {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        text-decoration: none;
        transition: transform 0.3s ease;
    }

    .navbar-brand .brand-link:hover {
        transform: translateY(-2px);
    }

    .brand-icon {
        font-size: 2rem;
        filter: drop-shadow(0 2px 4px rgba(102, 126, 234, 0.3));
    }

    .brand-text {
        display: flex;
        flex-direction: column;
        gap: 0.1rem;
    }

    .brand-name {
        font-size: 1.2rem;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .brand-tagline {
        font-size: 0.7rem;
        color: #666 !important;
        font-weight: 500;
        letter-spacing: 0.5px;
    }

    .mobile-toggle {
        display: none;
        flex-direction: column;
        gap: 5px;
        background: none;
        border: none;
        cursor: pointer;
        padding: 8px;
        z-index: 1001;
    }

    .mobile-toggle span {
        width: 25px;
        height: 3px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 2px;
        transition: all 0.3s ease;
    }

    .mobile-toggle.active span:nth-child(1) {
        transform: rotate(45deg) translate(8px, 8px);
    }

    .mobile-toggle.active span:nth-child(2) {
        opacity: 0;
    }

    .mobile-toggle.active span:nth-child(3) {
        transform: rotate(-45deg) translate(7px, -7px);
    }

    .navbar-menu {
        display: flex;
        align-items: center;
        gap: 2rem;
        flex: 1;
        justify-content: space-between;
        margin-left: 3rem;
    }

    .navbar-links {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .nav-link {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.6rem 1rem;
        color: #333 !important;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.95rem;
        border-radius: 10px;
        transition: all 0.3s ease;
        position: relative;
    }

    .nav-link:hover {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        transform: translateY(-2px);
        color: #667eea !important;
    }

    .nav-link.active {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white !important;
    }

    .nav-link.active .nav-icon {
        filter: none;
    }

    .nav-icon {
        font-size: 1.1rem;
        filter: drop-shadow(0 1px 2px rgba(0, 0, 0, 0.1));
    }

    .navbar-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .btn-login, .btn-register {
        padding: 0.6rem 1.5rem;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .btn-login {
        color: #667eea !important;
        background: transparent;
        border: 2px solid #667eea;
    }

    .btn-login:hover {
        background: #667eea;
        color: white !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .btn-register {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white !important;
        border: none;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    .user-menu-wrapper {
        position: relative;
    }

    .user-menu-toggle {
        display: flex;
        align-items: center;
        gap: 0.7rem;
        padding: 0.5rem 1rem;
        background: rgba(102, 126, 234, 0.05);
        border: 2px solid rgba(102, 126, 234, 0.1);
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
        color: #333 !important;
    }

    .user-menu-toggle:hover {
        background: rgba(102, 126, 234, 0.1);
        border-color: rgba(102, 126, 234, 0.3);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.15);
    }

    .user-avatar, .user-avatar-placeholder {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        object-fit: cover;
    }

    .user-avatar-placeholder {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white !important;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.1rem;
    }

    .user-name {
        font-size: 0.95rem;
        max-width: 150px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        color: #333 !important;
    }

    .dropdown-arrow {
        transition: transform 0.3s ease;
    }

    .user-menu-toggle.active .dropdown-arrow {
        transform: rotate(180deg);
    }

    .user-dropdown {
        position: absolute;
        top: calc(100% + 10px);
        right: 0;
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        min-width: 250px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .user-dropdown.active {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .dropdown-header {
        padding: 1.5rem;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        border-radius: 15px 15px 0 0;
    }

    .dropdown-user-info {
        display: flex;
        flex-direction: column;
        gap: 0.3rem;
    }

    .dropdown-user-name {
        font-weight: 700;
        font-size: 1.1rem;
        color: #333 !important;
    }

    .dropdown-user-email {
        font-size: 0.85rem;
        color: #666 !important;
    }

    .dropdown-user-role {
        display: inline-block;
        padding: 0.3rem 0.8rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white !important;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-top: 0.5rem;
        width: fit-content;
    }

    .dropdown-divider {
        height: 1px;
        background: rgba(0, 0, 0, 0.05);
        margin: 0.5rem 0;
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 0.7rem;
        padding: 1rem 1.5rem;
        color: #333 !important;
        text-decoration: none;
        transition: all 0.3s ease;
        width: 100%;
        border: none;
        background: none;
        cursor: pointer;
        font-size: 0.95rem;
        font-weight: 500;
        text-align: left;
    }

    .dropdown-item:hover {
        background: rgba(102, 126, 234, 0.05);
    }

    .logout-btn {
        color: #ef4444 !important;
        border-radius: 0 0 15px 15px;
    }

    .logout-btn:hover {
        background: rgba(239, 68, 68, 0.05);
    }

    .dropdown-icon {
        font-size: 1.2rem;
    }

    @media (max-width: 1024px) {
        .navbar-container {
            padding: 0 1.5rem;
        }

        .navbar-menu {
            margin-left: 2rem;
        }

        .navbar-links {
            gap: 0.3rem;
        }

        .nav-link {
            padding: 0.5rem 0.8rem;
            font-size: 0.9rem;
        }

        .user-name {
            display: none;
        }
    }

    @media (max-width: 768px) {
        .mobile-toggle {
            display: flex;
        }

        .navbar-menu {
            position: fixed;
            top: 70px;
            left: 0;
            right: 0;
            background: white;
            flex-direction: column;
            padding: 2rem;
            gap: 1.5rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            transform: translateY(-100%);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            margin-left: 0;
            align-items: stretch;
            max-height: calc(100vh - 70px);
            overflow-y: auto;
        }

        .navbar-menu.active {
            transform: translateY(0);
            opacity: 1;
            visibility: visible;
        }

        .navbar-links {
            flex-direction: column;
            gap: 0.5rem;
        }

        .nav-link {
            padding: 1rem;
            justify-content: flex-start;
        }

        .navbar-actions {
            flex-direction: column;
            width: 100%;
        }

        .btn-login, .btn-register {
            width: 100%;
        }

        .user-menu-toggle {
            width: 100%;
            justify-content: space-between;
        }

        .user-name {
            display: block;
        }

        .user-dropdown {
            position: static;
            transform: none;
            margin-top: 0.5rem;
            box-shadow: none;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }
    }
</style>

<script>
    // Mobile menu toggle
    const mobileToggle = document.getElementById('mobileToggle');
    const navbarMenu = document.getElementById('navbarMenu');

    if (mobileToggle) {
        mobileToggle.addEventListener('click', () => {
            mobileToggle.classList.toggle('active');
            navbarMenu.classList.toggle('active');
        });
    }

    // User dropdown toggle
    const userMenuToggle = document.getElementById('userMenuToggle');
    const userDropdown = document.getElementById('userDropdown');

    if (userMenuToggle && userDropdown) {
        userMenuToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            userMenuToggle.classList.toggle('active');
            userDropdown.classList.toggle('active');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!userMenuToggle.contains(e.target) && !userDropdown.contains(e.target)) {
                userMenuToggle.classList.remove('active');
                userDropdown.classList.remove('active');
            }
        });
    }

    // Handle logout form to prevent CSRF token expiry issues
    const logoutForm = document.getElementById('logout-form');
    if (logoutForm) {
        logoutForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Fetch fresh CSRF token and submit
            fetch('{{ route("logout") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            })
            .then(response => {
                if (response.ok || response.redirected) {
                    window.location.href = '/';
                } else if (response.status === 419) {
                    // Session expired, just redirect to home
                    window.location.href = '/';
                } else {
                    // Try form submission as fallback
                    logoutForm.submit();
                }
            })
            .catch(error => {
                console.error('Logout error:', error);
                // Fallback to regular form submission
                logoutForm.submit();
            });
        });
    }

    // Highlight active nav link
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
        }
    });

    // Close mobile menu when clicking a link
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth <= 768) {
                mobileToggle.classList.remove('active');
                navbarMenu.classList.remove('active');
            }
        });
    });
</script>