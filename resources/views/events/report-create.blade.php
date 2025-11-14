@extends('layouts.app')

@section('title', 'Create Event Report')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Create Event Report - {{ $event->title }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('events.report.store', $event->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Report Title *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="summary" class="form-label">Executive Summary *</label>
                            <textarea class="form-control @error('summary') is-invalid @enderror" 
                                      id="summary" name="summary" rows="5" required>{{ old('summary') }}</textarea>
                            @error('summary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="total_attendees" class="form-label">Total Attendees *</label>
                                <input type="number" class="form-control @error('total_attendees') is-invalid @enderror" 
                                       id="total_attendees" name="total_attendees" value="{{ old('total_attendees', $event->registrations->where('status', 'attended')->count()) }}" required min="0">
                                @error('total_attendees')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="total_participants" class="form-label">Total Participants *</label>
                                <input type="number" class="form-control @error('total_participants') is-invalid @enderror" 
                                       id="total_participants" name="total_participants" value="{{ old('total_participants') }}" required min="0">
                                @error('total_participants')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="outcomes" class="form-label">Key Outcomes</label>
                            <textarea class="form-control @error('outcomes') is-invalid @enderror" 
                                      id="outcomes" name="outcomes" rows="4">{{ old('outcomes') }}</textarea>
                            @error('outcomes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="highlights" class="form-label">Event Highlights</label>
                            <textarea class="form-control @error('highlights') is-invalid @enderror" 
                                      id="highlights" name="highlights" rows="4">{{ old('highlights') }}</textarea>
                            @error('highlights')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="report_file" class="form-label">Upload Detailed Report (PDF/DOC)</label>
                            <input type="file" class="form-control @error('report_file') is-invalid @enderror" 
                                   id="report_file" name="report_file" accept=".pdf,.doc,.docx">
                            <small class="text-muted">Optional - Max 10MB</small>
                            @error('report_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create Report
                            </button>
                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
