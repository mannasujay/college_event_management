<nav class="navbar">
    <div class="navbar-brand">
        <a href="{{ url('/') }}">🎓 College Event Management</a>
    </div>
    
    <div class="navbar-menu">
        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
                <a href="{{ route('admin.users') }}">👥 Users</a>
                <a href="{{ route('admin.manage-events') }}">📅 Events</a>
                <a href="{{ route('admin.announcements') }}">📢 Announcements</a>
            @elseif(auth()->user()->role === 'organizer')
                <a href="{{ route('organizer.dashboard') }}">📊 Dashboard</a>
                <a href="{{ route('organizer.events.index') }}">📅 My Events</a>
                <a href="{{ route('organizer.events.create') }}">➕ Create Event</a>
                <a href="{{ route('organizer.feedbacks') }}">💬 Feedbacks</a>
            @else
                <a href="{{ route('student.dashboard') }}">📊 Dashboard</a>
                <a href="{{ route('student.event-list') }}">📅 Events</a>
                <a href="{{ route('my-registrations') }}">📝 My Registrations</a>
                <a href="{{ route('student.feedback') }}">💬 Feedback</a>
            @endif

            <a href="{{ route('home') }}">🏠 Home</a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit">🚪 Logout</button>
            </form>
        @else
            <a href="{{ route('home') }}">🏠 Home</a>
            <a href="{{ route('events.index') }}">📅 Events</a>
            <a href="{{ route('about') }}">ℹ️ About</a>
            <a href="{{ route('contact') }}">📧 Contact</a>
            <a href="{{ route('login') }}">🔐 Login</a>
            <a href="{{ route('register') }}">✍️ Register</a>
        @endauth
    </div>
</nav>
