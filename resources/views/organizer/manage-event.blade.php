@extends('layouts.organizer')

@section('title', 'Manage Event')

@section('content')
<div class="manage-event">
    <h1>Manage Events</h1>
    
    @livewire('event-list')
</div>
@endsection
