@extends('layouts.app')

@section('content')
<div class="feedback-container">
    <div class="feedback-card">
        <div class="card-header">
            <div class="header-icon">💬</div>
            <h1>Submit Event Feedback</h1>
            <p>Share your experience and help us improve</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                ✓ {{ session('success') }}
            </div>
        @endif

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

        @if($attendedEvents->count() > 0)
            <form method="POST" action="{{ route('student.submit-feedback') }}" class="feedback-form">
                @csrf
                
                <div class="form-section">
                    <div class="form-group">
                        <label for="event_id">Select Event <span class="required">*</span></label>
                        <select id="event_id" name="event_id" required>
                            <option value="">Choose an event you attended</option>
                            @foreach($attendedEvents as $event)
                                <option value="{{ $event->id }}" {{ old('event_id') == $event->id ? 'selected' : '' }}>
                                    {{ $event->name }} - {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                                </option>
                            @endforeach
                        </select>
                        <small class="form-hint">Select the event you want to provide feedback for</small>
                    </div>

                    <div class="form-group">
                        <label for="rating">Rating <span class="required">*</span></label>
                        <div class="rating-input">
                            <div class="star-rating">
                                <input type="radio" id="star5" name="rating" value="5" {{ old('rating') == 5 ? 'checked' : '' }} required>
                                <label for="star5">⭐</label>
                                
                                <input type="radio" id="star4" name="rating" value="4" {{ old('rating') == 4 ? 'checked' : '' }}>
                                <label for="star4">⭐</label>
                                
                                <input type="radio" id="star3" name="rating" value="3" {{ old('rating') == 3 ? 'checked' : '' }}>
                                <label for="star3">⭐</label>
                                
                                <input type="radio" id="star2" name="rating" value="2" {{ old('rating') == 2 ? 'checked' : '' }}>
                                <label for="star2">⭐</label>
                                
                                <input type="radio" id="star1" name="rating" value="1" {{ old('rating') == 1 ? 'checked' : '' }}>
                                <label for="star1">⭐</label>
                            </div>
                        </div>
                        <small class="form-hint">Rate your overall experience (1 = Poor, 5 = Excellent)</small>
                    </div>

                    <div class="form-group">
                        <label for="comment">Your Feedback <span class="required">*</span></label>
                        <textarea 
                            id="comment" 
                            name="comment" 
                            rows="6" 
                            placeholder="Share your thoughts about the event... What did you like? What could be improved?"
                            required
                        >{{ old('comment') }}</textarea>
                        <small class="form-hint">Maximum 1000 characters</small>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="reset" class="btn btn-secondary">
                        🔄 Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        📤 Submit Feedback
                    </button>
                </div>
            </form>
        @else
            <div class="no-events">
                <div class="empty-icon">⏳</div>
                <h3>No Completed Events</h3>
                <p>You can only provide feedback after an event has been completed. Register for upcoming events and return here after attending!</p>
                <a href="{{ route('student.event-list') }}" class="btn btn-primary">
                    🔍 Browse Upcoming Events
                </a>
            </div>
        @endif
    </div>
</div>

<style>
    .feedback-container {
        min-height: calc(100vh - 200px);
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 2rem 1rem;
    }

    .feedback-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        max-width: 700px;
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

    .feedback-form {
        padding: 2rem;
    }

    .form-section {
        margin-bottom: 2rem;
    }

    .form-group {
        margin-bottom: 2rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.8rem;
        font-weight: 600;
        color: #2c3e50;
        font-size: 0.95rem;
    }

    .required {
        color: #ef4444;
    }

    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 1rem;
        border: 2px solid #e1e8ed;
        border-radius: 12px;
        font-size: 0.95rem;
        font-family: inherit;
        transition: all 0.3s ease;
    }

    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .form-group textarea {
        resize: vertical;
    }

    .form-hint {
        display: block;
        margin-top: 0.5rem;
        font-size: 0.85rem;
        color: #666;
        font-style: italic;
    }

    .rating-input {
        margin: 1rem 0;
    }

    .star-rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
        gap: 0.5rem;
    }

    .star-rating input[type="radio"] {
        display: none;
    }

    .star-rating label {
        font-size: 2.5rem;
        cursor: pointer;
        transition: all 0.3s ease;
        filter: grayscale(100%);
        opacity: 0.5;
    }

    .star-rating input[type="radio"]:checked ~ label,
    .star-rating label:hover,
    .star-rating label:hover ~ label {
        filter: grayscale(0%);
        opacity: 1;
        transform: scale(1.1);
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

    .alert-success {
        background: rgba(34, 197, 94, 0.1);
        border-color: #22c55e;
        color: #166534;
    }

    .alert-error {
        background: rgba(239, 68, 68, 0.1);
        border-color: #ef4444;
        color: #991b1b;
    }

    .no-events {
        text-align: center;
        padding: 4rem 2rem;
    }

    .empty-icon {
        font-size: 5rem;
        margin-bottom: 1.5rem;
        opacity: 0.7;
    }

    .no-events h3 {
        font-size: 1.8rem;
        color: #2c3e50;
        margin-bottom: 1rem;
    }

    .no-events p {
        color: #666;
        font-size: 1.1rem;
        margin-bottom: 2rem;
    }

    @media (max-width: 768px) {
        .feedback-container {
            padding: 1rem 0.5rem;
        }

        .card-header {
            padding: 2rem 1rem;
        }

        .card-header h1 {
            font-size: 1.5rem;
        }

        .feedback-form {
            padding: 1.5rem;
        }

        .form-actions {
            flex-direction: column;
        }

        .star-rating label {
            font-size: 2rem;
        }

        .alert {
            margin: 1rem;
        }
    }
</style>
@endsection
