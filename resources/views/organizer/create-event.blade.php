@extends('layouts.organizer')

@section('title', 'Create Event')

@section('content')
<div class="create-event">
    <h1>Create New Event</h1>
    
    <form method="POST" action="{{ route('organizer.store-event') }}" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="title">Event Title</label>
            <input type="text" id="title" name="title" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" required></textarea>
        </div>
        
        <div class="form-group">
            <label for="event_date">Event Date</label>
            <input type="datetime-local" id="event_date" name="event_date" required>
        </div>
        
        <div class="form-group">
            <label for="venue">Venue</label>
            <input type="text" id="venue" name="venue" required>
        </div>
        
        <div class="form-group">
            <label for="max_participants">Maximum Participants</label>
            <input type="number" id="max_participants" name="max_participants" required>
        </div>
        
        <div class="form-group">
            <label for="banner_image">Banner Image</label>
            <input type="file" id="banner_image" name="banner_image" accept="image/*">
        </div>
        
        <button type="submit" class="btn btn-primary">Create Event</button>
    </form>
</div>
@endsection
