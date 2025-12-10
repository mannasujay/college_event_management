<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - College Event Management</title>
    <link href="{{ asset('css/professional-theme.css') }}" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: linear-gradient(135deg, var(--primary-600) 0%, var(--secondary-600) 100%);
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            border-radius: 50%;
            top: -250px;
            right: -250px;
            animation: float 20s ease-in-out infinite;
        }

        body::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);
            border-radius: 50%;
            bottom: -200px;
            left: -200px;
            animation: float 15s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(30px, -30px) rotate(120deg); }
            66% { transform: translate(-20px, 20px) rotate(240deg); }
        }

        /* Top Navigation Bar */
        .top-nav {
            position: relative;
            z-index: 100;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            padding: 0 var(--space-6);
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            color: white;
            text-decoration: none;
            font-weight: var(--font-bold);
            font-size: var(--text-xl);
        }

        .nav-logo-icon {
            font-size: var(--text-3xl);
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: var(--space-2);
        }

        .nav-dropdown {
            position: relative;
        }

        .dropdown-toggle {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            padding: var(--space-3) var(--space-5);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--radius-lg);
            color: white;
            font-weight: var(--font-medium);
            font-size: var(--text-sm);
            cursor: pointer;
            transition: all 0.3s;
        }

        .dropdown-toggle:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .dropdown-arrow {
            transition: transform 0.3s;
            font-size: 0.8em;
        }

        .nav-dropdown.active .dropdown-arrow {
            transform: rotate(180deg);
        }

        .dropdown-menu {
            position: absolute;
            top: calc(100% + var(--space-2));
            right: 0;
            min-width: 220px;
            background: white;
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-2xl);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s;
            overflow: hidden;
        }

        .nav-dropdown.active .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            padding: var(--space-4);
            color: var(--gray-700);
            text-decoration: none;
            transition: all 0.2s;
            border-bottom: 1px solid var(--gray-100);
        }

        .dropdown-item:last-child {
            border-bottom: none;
        }

        .dropdown-item:hover {
            background: var(--primary-50);
            color: var(--primary-700);
        }

        .dropdown-item-icon {
            font-size: var(--text-xl);
        }

        .dropdown-item-text {
            flex: 1;
        }

        .dropdown-item-label {
            font-weight: var(--font-semibold);
            font-size: var(--text-sm);
            display: block;
        }

        .dropdown-item-desc {
            font-size: var(--text-xs);
            color: var(--gray-500);
            margin-top: 2px;
        }

        /* Main Content */
        .auth-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: var(--space-8) var(--space-6);
        }

        .auth-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 450px;
        }

        .auth-card {
            background: white;
            border-radius: var(--radius-2xl);
            box-shadow: var(--shadow-2xl);
            padding: var(--space-12);
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

        .auth-header {
            text-align: center;
            margin-bottom: var(--space-10);
        }

        .auth-logo {
            font-size: 3.5rem;
            margin-bottom: var(--space-4);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .auth-title {
            font-size: var(--text-3xl);
            font-weight: var(--font-bold);
            color: var(--gray-900);
            margin-bottom: var(--space-2);
        }

        .auth-subtitle {
            color: var(--gray-600);
            font-size: var(--text-base);
        }

        .form-group {
            margin-bottom: var(--space-6);
        }

        .form-label {
            display: block;
            margin-bottom: var(--space-2);
            color: var(--gray-700);
            font-weight: var(--font-medium);
            font-size: var(--text-sm);
        }

        .form-input {
            width: 100%;
            padding: var(--space-4);
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-lg);
            font-size: var(--text-base);
            transition: all 0.3s;
            font-family: inherit;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary-500);
            box-shadow: 0 0 0 4px var(--primary-100);
        }

        .form-input.error {
            border-color: var(--danger-500);
        }

        .error-message {
            color: var(--danger-600);
            font-size: var(--text-sm);
            margin-top: var(--space-2);
            display: flex;
            align-items: center;
            gap: var(--space-2);
        }

        .success-message {
            background: var(--success-50);
            color: var(--success-700);
            padding: var(--space-4);
            border-radius: var(--radius-lg);
            margin-bottom: var(--space-6);
            border-left: 4px solid var(--success-600);
            font-size: var(--text-sm);
        }

        .forgot-password {
            text-align: right;
            margin-top: var(--space-2);
        }

        .forgot-password a {
            color: var(--primary-600);
            text-decoration: none;
            font-size: var(--text-sm);
            font-weight: var(--font-medium);
            transition: color 0.3s;
        }

        .forgot-password a:hover {
            color: var(--primary-700);
        }

        .btn-primary {
            width: 100%;
            padding: var(--space-4);
            background: linear-gradient(135deg, var(--primary-600), var(--primary-700));
            color: white;
            border: none;
            border-radius: var(--radius-lg);
            font-size: var(--text-base);
            font-weight: var(--font-semibold);
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: var(--shadow-md);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .divider {
            text-align: center;
            margin: var(--space-8) 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            height: 1px;
            background: var(--gray-200);
        }

        .divider-text {
            background: white;
            padding: 0 var(--space-4);
            position: relative;
            color: var(--gray-500);
            font-size: var(--text-sm);
        }

        .social-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: var(--space-4);
            margin-bottom: var(--space-8);
        }

        .btn-social {
            padding: var(--space-3);
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-lg);
            background: white;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: var(--space-2);
            font-weight: var(--font-medium);
            font-size: var(--text-sm);
            text-decoration: none;
            color: var(--gray-700);
        }

        .btn-social:hover {
            border-color: var(--primary-300);
            background: var(--primary-50);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .auth-footer {
            text-align: center;
            margin-top: var(--space-8);
            padding-top: var(--space-8);
            border-top: 1px solid var(--gray-200);
        }

        .auth-link {
            color: var(--gray-600);
            font-size: var(--text-sm);
        }

        .auth-link a {
            color: var(--primary-600);
            text-decoration: none;
            font-weight: var(--font-semibold);
            transition: color 0.3s;
        }

        .auth-link a:hover {
            color: var(--primary-700);
        }

        @media (max-width: 768px) {
            .auth-card {
                padding: var(--space-8);
            }

            .social-buttons {
                grid-template-columns: 1fr;
            }

            .nav-container {
                padding: 0 var(--space-4);
            }

            .nav-logo-text {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Top Navigation with Dropdown -->
    <nav class="top-nav">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="nav-logo">
                <span class="nav-logo-icon">🎓</span>
                <span class="nav-logo-text">College Events</span>
            </a>
            
            <div class="nav-menu">
                <div class="nav-dropdown" id="navDropdown">
                    <button class="dropdown-toggle" onclick="toggleDropdown()">
                        <span>Menu</span>
                        <span class="dropdown-arrow">▼</span>
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{ route('home') }}" class="dropdown-item">
                            <span class="dropdown-item-icon">🏠</span>
                            <span class="dropdown-item-text">
                                <span class="dropdown-item-label">Home</span>
                                <span class="dropdown-item-desc">Back to homepage</span>
                            </span>
                        </a>
                        <a href="{{ route('register') }}" class="dropdown-item">
                            <span class="dropdown-item-icon">✨</span>
                            <span class="dropdown-item-text">
                                <span class="dropdown-item-label">Create Account</span>
                                <span class="dropdown-item-desc">Join our community</span>
                            </span>
                        </a>
                        <a href="{{ route('events.index') }}" class="dropdown-item">
                            <span class="dropdown-item-icon">📅</span>
                            <span class="dropdown-item-text">
                                <span class="dropdown-item-label">Browse Events</span>
                                <span class="dropdown-item-desc">Explore all events</span>
                            </span>
                        </a>
                        <a href="{{ route('password.forgot') }}" class="dropdown-item">
                            <span class="dropdown-item-icon">🔑</span>
                            <span class="dropdown-item-text">
                                <span class="dropdown-item-label">Forgot Password</span>
                                <span class="dropdown-item-desc">Reset your password</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="auth-wrapper">
        <div class="auth-container">
            <div class="auth-card">
                <div class="auth-header">
                    <div class="auth-logo">🎓</div>
                    <h1 class="auth-title">Welcome Back</h1>
                    <p class="auth-subtitle">Sign in to access your dashboard</p>
                </div>

                @if(session('success'))
                <div class="success-message">
                    ✓ {{ session('success') }}
                </div>
                @endif

                @if($errors->any())
                <div class="error-message" style="background: var(--danger-50); padding: var(--space-4); border-radius: var(--radius-lg); margin-bottom: var(--space-6); border-left: 4px solid var(--danger-600);">
                    <span>⚠️</span>
                    <div>
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
                @endif

                <form action="{{ route('login') }}" method="POST")
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-input @error('email') error @enderror" 
                        placeholder="you@example.com"
                        value="{{ old('email') }}"
                        required
                    >
                    @error('email')
                    <span class="error-message">⚠️ {{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-input @error('password') error @enderror" 
                        placeholder="••••••••"
                        required
                    >
                    @error('password')
                    <span class="error-message">⚠️ {{ $message }}</span>
                    @enderror
                    <div class="forgot-password">
                        <a href="{{ route('password.forgot') }}">Forgot password?</a>
                    </div>
                </div>

                <button type="submit" class="btn-primary">
                    Sign In
                </button>
            </form>

            <div class="divider">
                <span class="divider-text">Or continue with</span>
            </div>

            <div class="social-buttons">
                <a href="{{ route('social.redirect.google') }}" class="btn-social">
                    <svg width="20" height="20" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    Google
                </a>
                <a href="{{ route('social.redirect.facebook') }}" class="btn-social">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#1877F2">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                    Facebook
                </a>
            </div>

            <div class="auth-footer">
                <p class="auth-link">
                    Don't have an account? <a href="{{ route('register') }}">Sign up now</a>
                </p>
            </div>
        </div>
        </div>
    </div>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('navDropdown');
            dropdown.classList.toggle('active');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('navDropdown');
            const isClickInside = dropdown.contains(event.target);
            
            if (!isClickInside && dropdown.classList.contains('active')) {
                dropdown.classList.remove('active');
            }
        });

        // Close dropdown on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                document.getElementById('navDropdown').classList.remove('active');
            }
        });
    </script>
</body>
</html>
