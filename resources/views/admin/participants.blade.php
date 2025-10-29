@extends('layouts.admin')

@section('title', 'Participants')

@section('content')
<div class="participants">
    <h1>Event Participants</h1>
    
    @livewire('participant-table')
</div>
@endsection
