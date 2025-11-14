@extends('layouts.app')

@section('title', 'Event Report - ' . $event->title)

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <a href="{{ route('events.show', $event->id) }}" class="text-decoration-none text-muted mb-2 d-inline-block">
            <i class="fas fa-arrow-left"></i> Back to Event
        </a>
        <h1 class="display-5 fw-bold">{{ $event->title }}</h1>
        <p class="text-muted">Event Report</p>
    </div>

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">{{ $event->report->title }}</h3>
        </div>
        <div class="card-body">
            <!-- Statistics Row -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <h2 class="text-primary mb-0">{{ $event->report->total_attendees }}</h2>
                            <p class="text-muted mb-0">Total Attendees</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <h2 class="text-success mb-0">{{ $event->report->total_participants }}</h2>
                            <p class="text-muted mb-0">Active Participants</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Executive Summary -->
            <div class="mb-4">
                <h4 class="text-primary mb-3">Executive Summary</h4>
                <p class="text-justify">{{ $event->report->summary }}</p>
            </div>

            <!-- Key Outcomes -->
            @if($event->report->outcomes)
            <div class="mb-4">
                <h4 class="text-primary mb-3">Key Outcomes</h4>
                <div class="bg-light p-3 rounded">
                    <p class="mb-0">{!! nl2br(e($event->report->outcomes)) !!}</p>
                </div>
            </div>
            @endif

            <!-- Event Highlights -->
            @if($event->report->highlights)
            <div class="mb-4">
                <h4 class="text-primary mb-3">Event Highlights</h4>
                <div class="bg-light p-3 rounded">
                    <p class="mb-0">{!! nl2br(e($event->report->highlights)) !!}</p>
                </div>
            </div>
            @endif

            <!-- Attached Report -->
            @if($event->report->report_file_path)
            <div class="mb-4">
                <h4 class="text-primary mb-3">Detailed Report</h4>
                <a href="{{ route('events.report.download', $event->report->id) }}" class="btn btn-outline-primary">
                    <i class="fas fa-download"></i> Download Detailed Report
                </a>
            </div>
            @endif

            <!-- Report Info -->
            <div class="border-top pt-3 mt-4">
                <p class="text-muted small mb-0">
                    <i class="fas fa-user"></i> Prepared by: {{ $event->report->creator->name }}<br>
                    <i class="fas fa-calendar"></i> Created on: {{ $event->report->created_at->format('F d, Y') }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
