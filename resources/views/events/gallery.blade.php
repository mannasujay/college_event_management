@extends('layouts.app')

@section('title', $event->title . ' - Photo Gallery')

@section('content')
<div class="container py-5">
    <!-- Event Header -->
    <div class="mb-4">
        <a href="{{ route('events.show', $event->id) }}" class="text-decoration-none text-muted mb-2 d-inline-block">
            <i class="fas fa-arrow-left"></i> Back to Event
        </a>
        <h1 class="display-5 fw-bold">{{ $event->title }}</h1>
        <p class="text-muted">Photo Gallery</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Upload Section (Only for organizers/admins) -->
    @if(auth()->check() && (auth()->user()->role_id == 1 || auth()->user()->role_id == 2))
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title mb-3">Upload Photos</h5>
            <form action="{{ route('events.photos.store', $event->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="photos" class="form-label">Select Photos</label>
                    <input type="file" class="form-control" name="photos[]" id="photos" multiple accept="image/*" required>
                    <small class="text-muted">You can select multiple photos. Max 5MB each.</small>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-upload"></i> Upload Photos
                </button>
            </form>
        </div>
    </div>
    @endif

    <!-- Photo Gallery Grid -->
    @if($event->photos->count() > 0)
    <div class="row g-3">
        @foreach($event->photos as $photo)
        <div class="col-md-4 col-sm-6">
            <div class="card h-100 photo-card">
                <img src="{{ asset('storage/' . $photo->photo_path) }}" 
                     class="card-img-top gallery-image" 
                     alt="{{ $photo->caption ?? 'Event Photo' }}"
                     data-bs-toggle="modal" 
                     data-bs-target="#photoModal{{ $photo->id }}"
                     style="height: 250px; object-fit: cover; cursor: pointer;">
                @if($photo->caption)
                <div class="card-body">
                    <p class="card-text small text-muted">{{ $photo->caption }}</p>
                </div>
                @endif
                @if(auth()->check() && (auth()->user()->role_id == 1 || auth()->user()->role_id == 2))
                <div class="card-footer bg-transparent">
                    <form action="{{ route('events.photos.destroy', $photo->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this photo?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
                @endif
            </div>

            <!-- Photo Modal -->
            <div class="modal fade" id="photoModal{{ $photo->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ $photo->caption ?? 'Event Photo' }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="{{ asset('storage/' . $photo->photo_path) }}" 
                                 class="img-fluid" 
                                 alt="{{ $photo->caption ?? 'Event Photo' }}">
                            @if($photo->caption)
                            <p class="mt-3 text-muted">{{ $photo->caption }}</p>
                            @endif
                            <p class="small text-muted">
                                Uploaded by {{ $photo->uploader->name }} on {{ $photo->created_at->format('M d, Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-5">
        <i class="fas fa-images fa-4x text-muted mb-3"></i>
        <h4 class="text-muted">No photos yet</h4>
        <p class="text-muted">Photos will be uploaded after the event.</p>
    </div>
    @endif
</div>

<style>
.photo-card {
    transition: transform 0.2s;
}

.photo-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.gallery-image:hover {
    opacity: 0.9;
}
</style>
@endsection
