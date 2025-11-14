@extends('layouts.app')

@section('title', 'Results - ' . $event->title)

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <a href="{{ route('events.show', $event->id) }}" class="text-decoration-none text-muted mb-2 d-inline-block">
            <i class="fas fa-arrow-left"></i> Back to Event
        </a>
        <h1 class="display-5 fw-bold">{{ $event->title }}</h1>
        <p class="text-muted">Event Results & Winners</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Podium for Top 3 -->
            @if($event->winners->where('position', '<=', 3)->count() > 0)
            <div class="card shadow-lg mb-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body text-white text-center py-5">
                    <h2 class="mb-4"><i class="fas fa-trophy"></i> Winners Podium</h2>
                    <div class="row align-items-end justify-content-center">
                        @foreach([2, 1, 3] as $pos)
                            @php
                                $winner = $event->winners->firstWhere('position', $pos);
                            @endphp
                            @if($winner)
                            <div class="col-md-4">
                                <div class="podium-block" style="opacity: {{ $pos == 1 ? '1' : '0.9' }};">
                                    <div class="position-badge" style="background: {{ $pos == 1 ? '#FFD700' : ($pos == 2 ? '#C0C0C0' : '#CD7F32') }}; color: #333; font-size: 2rem; width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; {{ $pos == 1 ? 'transform: scale(1.2);' : '' }}">
                                        {{ $pos }}
                                    </div>
                                    <div class="bg-white text-dark rounded p-4 shadow" style="{{ $pos == 1 ? 'margin-top: -20px;' : 'margin-top: 20px;' }}">
                                        <h4 class="mb-2">{{ $winner->user->name }}</h4>
                                        @if($winner->prize)
                                        <p class="text-muted mb-2"><i class="fas fa-gift"></i> {{ $winner->prize }}</p>
                                        @endif
                                        @if($winner->description)
                                        <p class="small text-muted mb-0">{{ $winner->description }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Other Winners -->
            @if($event->winners->where('position', '>', 3)->count() > 0)
            <div class="card shadow">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Other Positions</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Position</th>
                                    <th>Name</th>
                                    <th>Prize</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($event->winners->where('position', '>', 3)->sortBy('position') as $winner)
                                <tr>
                                    <td><strong>#{{ $winner->position }}</strong></td>
                                    <td>{{ $winner->user->name }}</td>
                                    <td>{{ $winner->prize ?? '-' }}</td>
                                    <td>{{ $winner->description ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            <!-- Special Mentions if only one winner -->
            @if($event->winners->count() == 1)
            <div class="text-center py-5">
                <i class="fas fa-trophy fa-4x text-warning mb-3"></i>
                <h3>Congratulations to the Winner!</h3>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
.podium-block {
    transition: transform 0.3s;
}

.podium-block:hover {
    transform: translateY(-10px);
}
</style>
@endsection
