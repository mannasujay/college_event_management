@extends('layouts.organizer')

@section('title', 'Create Event')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');
    
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Inter', sans-serif;
    }
    
    .create-event-page {
        min-height: 100vh;
        background: #f8fafc;
        padding: 2.5rem 1.5rem;
    }
    
    .create-event-container {
        max-width: 950px;
        margin: 0 auto;
        animation: fadeInUp 0.5s ease-out;
    }
    
    .page-header {
        margin-bottom: 2.5rem;
    }
    
    .page-header h1 {
        font-size: 2.75rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 0.5rem;
        letter-spacing: -1px;
    }
    
    .page-header p {
        color: #64748b;
        font-size: 1.125rem;
        font-weight: 500;
    }
    
    .form-card {
        background: white;
        border-radius: 24px;
        padding: 3rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
    }
    
    .form-section {
        margin-bottom: 2.5rem;
    }
    
    .form-section:last-child {
        margin-bottom: 0;
    }
    
    .form-section-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 1.75rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .form-section-title::before {
        content: '';
        width: 4px;
        height: 24px;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        border-radius: 2px;
    }
    
    .form-group {
        margin-bottom: 2rem;
    }
    
    .form-group label {
        display: block;
        font-size: 0.875rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .form-group input[type="text"],
    .form-group input[type="datetime-local"],
    .form-group input[type="number"],
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 1rem 1.25rem;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 500;
        color: #1e293b;
        transition: all 0.2s ease;
        background: #f8fafc;
    }
    
    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        outline: none;
        border-color: #6366f1;
        background: white;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }
    
    .form-group textarea {
        resize: vertical;
        min-height: 140px;
        font-family: 'Inter', sans-serif;
        line-height: 1.6;
    }
    
    .form-group input[type="file"] {
        width: 100%;
        padding: 1.5rem;
        border: 2px dashed #cbd5e0;
        border-radius: 12px;
        background: #f8fafc;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 0.95rem;
        color: #64748b;
    }
    
    .form-group input[type="file"]:hover {
        border-color: #6366f1;
        background: white;
    }
    
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }
    
    .form-hint {
        font-size: 0.875rem;
        color: #64748b;
        margin-top: 0.5rem;
        font-weight: 500;
        line-height: 1.5;
    }
    
    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 3rem;
        padding-top: 2.5rem;
        border-top: 2px solid #f1f5f9;
    }
    
    .btn {
        padding: 1.125rem 2.5rem;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: none;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        flex: 1;
        position: relative;
        overflow: hidden;
    }
    
    .btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }
    
    .btn-primary:hover::before {
        left: 100%;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(99, 102, 241, 0.5);
    }
    
    .btn-secondary {
        background: #f1f5f9;
        color: #475569;
        padding: 1.125rem 2rem;
        border: 2px solid #e2e8f0;
    }
    
    .btn-secondary:hover {
        background: #e2e8f0;
        border-color: #cbd5e0;
    }
    
    .error-message {
        background: #fef2f2;
        border: 2px solid #fecaca;
        color: #991b1b;
        padding: 1.25rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        font-size: 0.9rem;
        font-weight: 600;
    }
    
    .error-message p {
        margin: 0.25rem 0;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @media (max-width: 768px) {
        .form-card {
            padding: 2rem;
        }
        
        .page-header h1 {
            font-size: 2.25rem;
        }
        
        .form-row {
            grid-template-columns: 1fr;
        }
        
        .form-actions {
            flex-direction: column;
        }
    }
</style>

<div class="create-event-page">
    <div class="create-event-container">
        <div class="page-header">
            <h1>Create New Event</h1>
            <p>Fill in the details to create an amazing event</p>
        </div>

        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="form-card">
            <form method="POST" action="{{ route('organizer.store-event') }}" enctype="multipart/form-data">
                @csrf
                
                <div class="form-section">
                    <h3 class="form-section-title">Basic Information</h3>
                    
                    <div class="form-group">
                        <label for="title">Event Title</label>
                        <input 
                            type="text" 
                            id="title" 
                            name="title" 
                            placeholder="Enter event title"
                            value="{{ old('title') }}"
                            required
                        >
                        <p class="form-hint">Choose a clear and engaging title for your event</p>
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea 
                            id="description" 
                            name="description" 
                            placeholder="Describe your event in detail..."
                            required
                        >{{ old('description') }}</textarea>
                        <p class="form-hint">Provide detailed information about the event</p>
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="form-section-title">Event Details</h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="event_date">Event Date & Time</label>
                            <input 
                                type="datetime-local" 
                                id="event_date" 
                                name="event_date"
                                value="{{ old('event_date') }}"
                                required
                            >
                        </div>
                        
                        <div class="form-group">
                            <label for="max_participants">Max Participants</label>
                            <input 
                                type="number" 
                                id="max_participants" 
                                name="max_participants"
                                placeholder="100"
                                value="{{ old('max_participants') }}"
                                min="1"
                                required
                            >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="venue">Venue</label>
                        <input 
                            type="text" 
                            id="venue" 
                            name="venue"
                            placeholder="Enter event location"
                            value="{{ old('venue') }}"
                            required
                        >
                        <p class="form-hint">Specify the exact location where the event will take place</p>
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="form-section-title">Event Media</h3>
                    
                    <div class="form-group">
                        <label for="banner_image">Banner Image</label>
                        <input 
                            type="file" 
                            id="banner_image" 
                            name="banner_image" 
                            accept="image/*"
                        >
                        <p class="form-hint">Upload an attractive banner image (recommended: 1200x600px)</p>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <span>✓</span>
                        <span>Create Event</span>
                    </button>
                    <a href="{{ route('organizer.events.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
