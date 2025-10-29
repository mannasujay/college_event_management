@extends('layouts.admin')

@section('title', 'Create Announcement')

@section('content')
<style>
    .create-announcement-page {
        padding: 2rem;
        max-width: 900px;
        margin: 0 auto;
    }

    .page-header {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .page-header h1 {
        color: #333;
        font-size: 2rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
    }

    .breadcrumb {
        color: #666;
        font-size: 0.9rem;
    }

    .breadcrumb a {
        color: #667eea;
        text-decoration: none;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

    .form-card {
        background: white;
        border-radius: 15px;
        padding: 2.5rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #333;
    }

    .form-group label span {
        color: #ef4444;
    }

    .form-control {
        width: 100%;
        padding: 0.8rem 1rem;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s;
        font-family: inherit;
    }

    .form-control:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    textarea.form-control {
        min-height: 150px;
        resize: vertical;
    }

    .priority-options {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }

    .priority-option {
        position: relative;
    }

    .priority-option input[type="radio"] {
        position: absolute;
        opacity: 0;
    }

    .priority-label {
        display: block;
        padding: 1rem;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        font-weight: 600;
    }

    .priority-option input[type="radio"]:checked + .priority-label {
        border-color: #667eea;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
    }

    .priority-high .priority-label {
        color: #991b1b;
    }

    .priority-option input[type="radio"]:checked + .priority-high.priority-label {
        border-color: #ef4444;
        background: #fee2e2;
    }

    .priority-medium .priority-label {
        color: #92400e;
    }

    .priority-option input[type="radio"]:checked + .priority-medium.priority-label {
        border-color: #f59e0b;
        background: #fef3c7;
    }

    .priority-low .priority-label {
        color: #065f46;
    }

    .priority-option input[type="radio"]:checked + .priority-low.priority-label {
        border-color: #10b981;
        background: #d1fae5;
    }

    .error-message {
        background: #fee2e2;
        color: #991b1b;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        margin-top: 0.5rem;
        font-size: 0.9rem;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }

    .btn {
        padding: 0.8rem 2rem;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        flex: 1;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-secondary {
        background: #e2e8f0;
        color: #333;
    }

    .btn-secondary:hover {
        background: #cbd5e0;
    }

    .form-info {
        background: #dbeafe;
        padding: 1rem 1.5rem;
        border-radius: 10px;
        margin-bottom: 2rem;
        color: #1e40af;
        border-left: 4px solid #3b82f6;
    }
</style>

<div class="create-announcement-page">
    <div class="page-header">
        <h1>📝 Create New Announcement</h1>
        <div class="breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a> / 
            <a href="{{ route('admin.announcements') }}">Announcements</a> / 
            Create
        </div>
    </div>

    <div class="form-card">
        <div class="form-info">
            💡 <strong>Tip:</strong> Announcements will be visible to all users. Use priority levels to highlight important messages.
        </div>

        <form action="{{ route('admin.announcements.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">
                    Announcement Title <span>*</span>
                </label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    class="form-control" 
                    placeholder="Enter announcement title"
                    value="{{ old('title') }}"
                    required
                >
                @error('title')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">
                    Content <span>*</span>
                </label>
                <textarea 
                    id="content" 
                    name="content" 
                    class="form-control" 
                    placeholder="Enter announcement content..."
                    required
                >{{ old('content') }}</textarea>
                @error('content')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>
                    Priority Level <span>*</span>
                </label>
                <div class="priority-options">
                    <div class="priority-option priority-high">
                        <input 
                            type="radio" 
                            id="priority-high" 
                            name="priority" 
                            value="high"
                            {{ old('priority') == 'high' ? 'checked' : '' }}
                        >
                        <label for="priority-high" class="priority-label">
                            🔴 High Priority
                        </label>
                    </div>

                    <div class="priority-option priority-medium">
                        <input 
                            type="radio" 
                            id="priority-medium" 
                            name="priority" 
                            value="medium"
                            {{ old('priority') == 'medium' || !old('priority') ? 'checked' : '' }}
                        >
                        <label for="priority-medium" class="priority-label">
                            🟡 Medium Priority
                        </label>
                    </div>

                    <div class="priority-option priority-low">
                        <input 
                            type="radio" 
                            id="priority-low" 
                            name="priority" 
                            value="low"
                            {{ old('priority') == 'low' ? 'checked' : '' }}
                        >
                        <label for="priority-low" class="priority-label">
                            🟢 Low Priority
                        </label>
                    </div>
                </div>
                @error('priority')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    ✓ Create Announcement
                </button>
                <a href="{{ route('admin.announcements') }}" class="btn btn-secondary">
                    ✕ Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
