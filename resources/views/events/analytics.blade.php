@extends('layouts.app')

@section('title', $event->title . ' - Analytics')

@section('content')
<div class="container py-5">
    <!-- Header -->
    <div class="mb-4">
        <a href="{{ route('events.show', $event->id) }}" class="text-decoration-none text-muted mb-2 d-inline-block">
            <i class="fas fa-arrow-left"></i> Back to Event
        </a>
        <h1 class="display-5 fw-bold">{{ $event->title }}</h1>
        <p class="text-muted">Event Analytics & Statistics</p>
    </div>

    <!-- Key Metrics -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="fas fa-users fa-2x text-primary mb-2"></i>
                    <h3 class="mb-0">{{ $totalRegistrations }}</h3>
                    <p class="text-muted mb-0">Total Registrations</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                    <h3 class="mb-0">{{ $attendedCount }}</h3>
                    <p class="text-muted mb-0">Attended</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="fas fa-percentage fa-2x text-info mb-2"></i>
                    <h3 class="mb-0">{{ $attendanceRate }}%</h3>
                    <p class="text-muted mb-0">Attendance Rate</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="fas fa-star fa-2x text-warning mb-2"></i>
                    <h3 class="mb-0">{{ number_format($averageRating, 1) }}</h3>
                    <p class="text-muted mb-0">Average Rating</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Attendance Chart -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Registration Status</h5>
                </div>
                <div class="card-body">
                    <canvas id="attendanceChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Rating Distribution -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Rating Distribution ({{ $totalFeedback }} reviews)</h5>
                </div>
                <div class="card-body">
                    @foreach([5,4,3,2,1] as $star)
                    <div class="mb-3">
                        <div class="d-flex align-items-center">
                            <span class="me-2" style="width: 60px;">{{ $star }} <i class="fas fa-star text-warning"></i></span>
                            <div class="progress flex-grow-1" style="height: 25px;">
                                <div class="progress-bar bg-warning" 
                                     style="width: {{ $totalFeedback > 0 ? ($ratingDistribution[$star] / $totalFeedback * 100) : 0 }}%">
                                    {{ $ratingDistribution[$star] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Department-wise Registration -->
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Department-wise Participation</h5>
                </div>
                <div class="card-body">
                    <canvas id="departmentChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Recent Feedback -->
        @if($event->feedback->count() > 0)
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Recent Feedback</h5>
                </div>
                <div class="card-body">
                    @foreach($event->feedback->take(5) as $feedback)
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <strong>{{ $feedback->user->name }}</strong>
                                <div class="text-warning">
                                    @for($i = 0; $i < $feedback->rating; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                </div>
                            </div>
                            <small class="text-muted">{{ $feedback->created_at->diffForHumans() }}</small>
                        </div>
                        @if($feedback->comment)
                        <p class="mb-0 mt-2 text-muted">{{ $feedback->comment }}</p>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Attendance Chart
    const attendanceCtx = document.getElementById('attendanceChart').getContext('2d');
    new Chart(attendanceCtx, {
        type: 'doughnut',
        data: {
            labels: ['Attended', 'Registered', 'Cancelled'],
            datasets: [{
                data: [{{ $attendedCount }}, {{ $totalRegistrations - $attendedCount - $cancelledCount }}, {{ $cancelledCount }}],
                backgroundColor: ['#28a745', '#ffc107', '#dc3545']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Department Chart
    const departmentCtx = document.getElementById('departmentChart').getContext('2d');
    new Chart(departmentCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($departmentStats->pluck('department')) !!},
            datasets: [{
                label: 'Registrations',
                data: {!! json_encode($departmentStats->pluck('count')) !!},
                backgroundColor: 'rgba(102, 126, 234, 0.8)',
                borderColor: 'rgba(102, 126, 234, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
@endsection
