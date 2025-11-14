@extends('layouts.app')

@section('title', 'Event Archive')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold">Event Archive</h1>
        <p class="lead text-muted">Explore past events and their memories</p>
    </div>

    <!-- Filter Section -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('events.archive') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search events..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="year" class="form-select">
                        <option value="">All Years</option>
                        @foreach($years as $year)
                        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="category" class="form-select">
                        <option value="">All Categories</option>
                        <option value="Technical" {{ request('category') == 'Technical' ? 'selected' : '' }}>Technical</option>
                        <option value="Cultural" {{ request('category') == 'Cultural' ? 'selected' : '' }}>Cultural</option>
                        <option value="Sports" {{ request('category') == 'Sports' ? 'selected' : '' }}>Sports</option>
                        <option value="Academic" {{ request('category') == 'Academic' ? 'selected' : '' }}>Academic</option>
                        <option value="Workshop" {{ request('category') == 'Workshop' ? 'selected' : '' }}>Workshop</option>
                        <option value="Seminar" {{ request('category') == 'Seminar' ? 'selected' : '' }}>Seminar</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Events Timeline -->
    @if($events->count() > 0)
    <div class="row g-4">
        @foreach($events as $event)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm hover-card">
                @if($event->banner_image)
                <img src="{{ asset('storage/' . $event->banner_image) }}" class="card-img-top" alt="{{ $event->title }}" style="height: 200px; object-fit: cover;">
                @else
                <div class="card-img-top bg-gradient d-flex align-items-center justify-content-center" style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <i class="fas fa-calendar-alt fa-3x text-white"></i>
                </div>
                @endif
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="badge bg-primary">{{ $event->category ?? 'Event' }}</span>
                        <small class="text-muted">
                            <i class="fas fa-calendar"></i> {{ $event->event_date->format('M d, Y') }}
                        </small>
                    </div>
                    <h5 class="card-title">{{ $event->title }}</h5>
                    <p class="card-text text-muted small">{{ Str::limit($event->description, 100) }}</p>
                    
                    <div class="mb-3">
                        <small class="text-muted">
                            <i class="fas fa-users"></i> {{ $event->registrations->count() }} participants
                        </small>
                    </div>

                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-outline-primary btn-sm w-100">
                        View Details <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                <div class="card-footer bg-transparent border-top-0">
                    <div class="d-flex gap-2 flex-wrap">
                        @if($event->photos && $event->photos->count() > 0)
                        <a href="{{ route('events.photos', $event->id) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-images"></i> Gallery
                        </a>
                        @endif
                        @if($event->winners && $event->winners->count() > 0)
                        <a href="{{ route('events.winners.show', $event->id) }}" class="btn btn-sm btn-outline-warning">
                            <i class="fas fa-trophy"></i> Results
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $events->links() }}
    </div>
    @else
    <div class="text-center py-5">
        <i class="fas fa-archive fa-4x text-muted mb-3"></i>
        <h4 class="text-muted">No archived events found</h4>
        <p class="text-muted">Try adjusting your filters or check back later.</p>
    </div>
    @endif
</div>

<style>
.hover-card {
    transition: transform 0.3s, box-shadow 0.3s;
}

.hover-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
}
</style>
@endsection
