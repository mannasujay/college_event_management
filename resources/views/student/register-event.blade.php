@extends('layouts.app')

@section('title', 'Register for Event')

@section('content')
<div class="register-event-container">
    <div class="register-card">
        <div class="card-header">
            <div class="header-icon">🎟️</div>
            <h1>Register for Event</h1>
            <p>Complete your registration to secure your spot</p>
        </div>

        @if(session('error'))
            <div class="alert alert-error">
                ✗ {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                @foreach($errors->all() as $error)
                    ✗ {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <div class="event-summary">
            <h3>📅 Event Details</h3>
            <div class="summary-grid">
                <div class="summary-item">
                    <span class="label">Event Name:</span>
                    <span class="value">{{ $event->name }}</span>
                </div>
                <div class="summary-item">
                    <span class="label">Date & Time:</span>
                    <span class="value">{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y, h:i A') }}</span>
                </div>
                <div class="summary-item">
                    <span class="label">Location:</span>
                    <span class="value">{{ $event->location }}</span>
                </div>
                @if($event->venue)
                <div class="summary-item">
                    <span class="label">Venue:</span>
                    <span class="value">{{ $event->venue }}</span>
                </div>
                @endif
                <div class="summary-item">
                    <span class="label">Category:</span>
                    <span class="value">{{ $event->category }}</span>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('student.register-event-submit', $id) }}" class="registration-form">
            @csrf
            
            <div class="form-section">
                <h3>👤 Your Information</h3>
                <div class="info-box">
                    <div class="info-item">
                        <span class="info-label">Name:</span>
                        <span class="info-value">{{ auth()->user()->name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email:</span>
                        <span class="info-value">{{ auth()->user()->email }}</span>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h3>💬 Additional Information</h3>
                <div class="form-group">
                    <label for="comments">Comments or Special Requirements (Optional)</label>
                    <textarea 
                        id="comments" 
                        name="comments" 
                        rows="5"
                        placeholder="Any dietary restrictions, accessibility needs, or other comments..."
                    ></textarea>
                    <small class="form-hint">Let us know if you have any special requirements or questions</small>
                </div>
            </div>

            <div class="terms-section">
                <label class="checkbox-container">
                    <input type="checkbox" name="agree_terms" required>
                    <span class="checkmark"></span>
                    <span class="checkbox-label">I agree to attend the event and follow all guidelines</span>
                </label>
            </div>

            <div class="form-actions">
                <a href="{{ route('student.event-list') }}" class="btn btn-secondary">
                    ← Back to Events
                </a>
                <button type="submit" class="btn btn-primary">
                    ✓ Confirm Registration
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .register-event-container {
        min-height: calc(100vh - 200px);
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 2rem 1rem;
    }

    .register-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        max-width: 800px;
        width: 100%;
        overflow: hidden;
        animation: slideUp 0.5s ease;
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

    .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 3rem 2rem;
        text-align: center;
    }

    .header-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
    }

    .card-header h1 {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        font-weight: 700;
    }

    .card-header p {
        font-size: 1.1rem;
        opacity: 0.95;
    }

    .event-summary {
        padding: 2rem;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 20%);
        border-bottom: 2px solid #e1e8ed;
    }

    .event-summary h3 {
        font-size: 1.3rem;
        color: #2c3e50;
        margin-bottom: 1.5rem;
        font-weight: 600;
    }

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
    }

    .summary-item {
        display: flex;
        flex-direction: column;
        gap: 0.3rem;
    }

    .summary-item .label {
        font-size: 0.85rem;
        color: #666;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .summary-item .value {
        font-size: 1rem;
        color: #2c3e50;
        font-weight: 600;
    }

    .registration-form {
        padding: 2rem;
    }

    .form-section {
        margin-bottom: 2rem;
    }

    .form-section h3 {
        font-size: 1.2rem;
        color: #2c3e50;
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .info-box {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 1.5rem;
        border: 2px solid #e1e8ed;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
    }

    .info-item:not(:last-child) {
        border-bottom: 1px solid #e1e8ed;
        margin-bottom: 0.5rem;
        padding-bottom: 1rem;
    }

    .info-label {
        font-weight: 600;
        color: #666;
    }

    .info-value {
        color: #2c3e50;
        font-weight: 500;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.8rem;
        font-weight: 600;
        color: #2c3e50;
        font-size: 0.95rem;
    }

    .form-group textarea {
        width: 100%;
        padding: 1rem;
        border: 2px solid #e1e8ed;
        border-radius: 12px;
        font-size: 0.95rem;
        font-family: inherit;
        transition: all 0.3s ease;
        resize: vertical;
    }

    .form-group textarea:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .form-hint {
        display: block;
        margin-top: 0.5rem;
        font-size: 0.85rem;
        color: #666;
        font-style: italic;
    }

    .terms-section {
        margin-bottom: 2rem;
        padding: 1.5rem;
        background: #fff3cd;
        border-radius: 12px;
        border-left: 4px solid #ffc107;
    }

    .checkbox-container {
        display: flex;
        align-items: center;
        cursor: pointer;
        user-select: none;
        gap: 0.8rem;
    }

    .checkbox-container input[type="checkbox"] {
        width: 20px;
        height: 20px;
        cursor: pointer;
    }

    .checkbox-label {
        font-size: 0.95rem;
        color: #2c3e50;
        font-weight: 500;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        padding-top: 1.5rem;
        border-top: 2px solid #e1e8ed;
    }

    .btn {
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        flex: 1;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    .btn-secondary {
        background: #f8f9fa;
        color: #2c3e50;
        border: 2px solid #e1e8ed;
    }

    .btn-secondary:hover {
        background: #e9ecef;
        border-color: #ced4da;
    }

    .alert {
        padding: 1rem 1.5rem;
        border-radius: 12px;
        margin: 1.5rem 2rem;
        font-size: 0.95rem;
        border-left: 4px solid;
    }

    .alert-error {
        background: rgba(239, 68, 68, 0.1);
        border-color: #ef4444;
        color: #991b1b;
    }

    @media (max-width: 768px) {
        .register-event-container {
            padding: 1rem 0.5rem;
        }

        .card-header {
            padding: 2rem 1rem;
        }

        .card-header h1 {
            font-size: 1.5rem;
        }

        .event-summary,
        .registration-form {
            padding: 1.5rem;
        }

        .summary-grid {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column;
        }

        .alert {
            margin: 1rem;
        }
    }
</style>
@endsection
