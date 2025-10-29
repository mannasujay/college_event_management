@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="home">
    <section class="hero">
        <h1>Welcome to College Event Management System</h1>
        <p>Discover and participate in exciting college events</p>
        <a href="{{ route('student.event-list') }}" class="btn btn-primary">Browse Events</a>
    </section>
    
    <section class="features">
        <div class="feature">
            <h3>Easy Registration</h3>
            <p>Register for events with just a few clicks</p>
        </div>
        
        <div class="feature">
            <h3>Real-time Updates</h3>
            <p>Stay updated with event announcements</p>
        </div>
        
        <div class="feature">
            <h3>Track Results</h3>
            <p>View event results and achievements</p>
        </div>
    </section>
</div>
@endsection
