@extends('layouts.admin')

@section('title', 'Announcements')

@section('content')
<style>
    .announcements-page {
        padding: 2rem;
    }

    .page-header {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .page-header h1 {
        color: #333;
        font-size: 2rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn {
        padding: 0.8rem 1.5rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        text-decoration: none;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        border: none;
        cursor: pointer;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .announcements-grid {
        display: grid;
        gap: 1.5rem;
    }

    .announcement-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
    }

    .announcement-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 5px;
        height: 100%;
    }

    .announcement-card.priority-high::before {
        background: #ef4444;
    }

    .announcement-card.priority-medium::before {
        background: #f59e0b;
    }

    .announcement-card.priority-low::before {
        background: #10b981;
    }

    .announcement-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .announcement-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 1rem;
    }

    .announcement-title {
        font-size: 1.5rem;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .announcement-meta {
        display: flex;
        gap: 1rem;
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .priority-badge {
        padding: 0.3rem 0.8rem;
        border-radius: 15px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .priority-high {
        background: #fee2e2;
        color: #991b1b;
    }

    .priority-medium {
        background: #fef3c7;
        color: #92400e;
    }

    .priority-low {
        background: #d1fae5;
        color: #065f46;
    }

    .announcement-content {
        color: #666;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .announcement-actions {
        display: flex;
        gap: 0.5rem;
    }

    .btn-danger {
        background: #ef4444;
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }

    .btn-danger:hover {
        box-shadow: 0 5px 15px rgba(239, 68, 68, 0.4);
    }

    .success-message {
        background: #d1fae5;
        color: #065f46;
        padding: 1rem 1.5rem;
        border-radius: 10px;
        margin-bottom: 1.5rem;
        border-left: 4px solid #10b981;
    }

    .no-announcements {
        background: white;
        border-radius: 15px;
        padding: 4rem 2rem;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .no-announcements-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
    }
</style>

<div class="announcements-page">
    <div class="page-header">
        <h1>📢 Announcements</h1>
        <a href="{{ route('admin.announcements.create') }}" class="btn">+ Create Announcement</a>
    </div>

    @if(session('success'))
        <div class="success-message">
            ✓ {{ session('success') }}
        </div>
    @endif

    @if($announcements->count() > 0)
        <div class="announcements-grid">
            @foreach($announcements as $announcement)
                <div class="announcement-card priority-{{ $announcement->priority }}">
                    <div class="announcement-header">
                        <div style="flex: 1;">
                            <h2 class="announcement-title">{{ $announcement->title }}</h2>
                            <div class="announcement-meta">
                                <span>👤 By {{ $announcement->creator->name }}</span>
                                <span>📅 {{ $announcement->created_at->format('M d, Y') }}</span>
                                <span class="priority-badge priority-{{ $announcement->priority }}">
                                    {{ ucfirst($announcement->priority) }} Priority
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="announcement-content">
                        {{ $announcement->content }}
                    </div>

                    <div class="announcement-actions">
                        <form action="{{ route('admin.announcements.destroy', $announcement) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this announcement?')">
                                🗑️ Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        @if($announcements->hasPages())
            <div style="margin-top: 2rem; display: flex; justify-content: center; gap: 0.5rem;">
                @if ($announcements->onFirstPage())
                    <span style="opacity: 0.5; padding: 0.5rem 1rem; background: white; border-radius: 8px;">← Previous</span>
                @else
                    <a href="{{ $announcements->previousPageUrl() }}" style="padding: 0.5rem 1rem; background: white; border-radius: 8px; text-decoration: none; color: #667eea;">← Previous</a>
                @endif

                @foreach ($announcements->getUrlRange(1, $announcements->lastPage()) as $page => $url)
                    @if ($page == $announcements->currentPage())
                        <span style="padding: 0.5rem 1rem; background: #667eea; color: white; border-radius: 8px;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" style="padding: 0.5rem 1rem; background: white; border-radius: 8px; text-decoration: none; color: #667eea;">{{ $page }}</a>
                    @endif
                @endforeach

                @if ($announcements->hasMorePages())
                    <a href="{{ $announcements->nextPageUrl() }}" style="padding: 0.5rem 1rem; background: white; border-radius: 8px; text-decoration: none; color: #667eea;">Next →</a>
                @else
                    <span style="opacity: 0.5; padding: 0.5rem 1rem; background: white; border-radius: 8px;">Next →</span>
                @endif
            </div>
        @endif
    @else
        <div class="no-announcements">
            <div class="no-announcements-icon">📢</div>
            <h3>No announcements yet</h3>
            <p style="color: #666; margin: 1rem 0;">Create your first announcement to notify users</p>
            <a href="{{ route('admin.announcements.create') }}" class="btn" style="margin-top: 1rem;">Create First Announcement</a>
        </div>
    @endif
</div>
@endsection
