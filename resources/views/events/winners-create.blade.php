@extends('layouts.app')

@section('title', 'Announce Results - ' . $event->title)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">Announce Results - {{ $event->title }}</h4>
                </div>
                <div class="card-body">
                    @if($event->winners->count() > 0)
                    <div class="alert alert-info">
                        This event already has announced results. Submitting this form will replace the existing results.
                    </div>
                    @endif

                    <form action="{{ route('events.winners.store', $event->id) }}" method="POST" id="winnersForm">
                        @csrf

                        <div id="winnersContainer">
                            <div class="winner-entry card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Participant *</label>
                                            <select name="winners[0][user_id]" class="form-select" required>
                                                <option value="">Select Winner</option>
                                                @foreach($participants as $participant)
                                                <option value="{{ $participant->id }}">{{ $participant->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label class="form-label">Position *</label>
                                            <input type="number" name="winners[0][position]" class="form-control" min="1" value="1" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Prize</label>
                                            <input type="text" name="winners[0][prize]" class="form-control" placeholder="e.g., Trophy, Certificate">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Description</label>
                                            <input type="text" name="winners[0][description]" class="form-control" placeholder="Additional details">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-outline-primary mb-3" id="addWinner">
                            <i class="fas fa-plus"></i> Add Another Winner
                        </button>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-trophy"></i> Announce Results
                            </button>
                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let winnerCount = 1;

document.getElementById('addWinner').addEventListener('click', function() {
    const container = document.getElementById('winnersContainer');
    const newEntry = document.createElement('div');
    newEntry.className = 'winner-entry card mb-3';
    newEntry.innerHTML = `
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="mb-0">Winner #${winnerCount + 1}</h6>
                <button type="button" class="btn btn-sm btn-danger remove-winner">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Participant *</label>
                    <select name="winners[${winnerCount}][user_id]" class="form-select" required>
                        <option value="">Select Winner</option>
                        @foreach($participants as $participant)
                        <option value="{{ $participant->id }}">{{ $participant->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label">Position *</label>
                    <input type="number" name="winners[${winnerCount}][position]" class="form-control" min="1" value="${winnerCount + 1}" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Prize</label>
                    <input type="text" name="winners[${winnerCount}][prize]" class="form-control" placeholder="e.g., Trophy, Certificate">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Description</label>
                    <input type="text" name="winners[${winnerCount}][description]" class="form-control" placeholder="Additional details">
                </div>
            </div>
        </div>
    `;
    container.appendChild(newEntry);
    winnerCount++;

    // Add event listener for remove button
    newEntry.querySelector('.remove-winner').addEventListener('click', function() {
        newEntry.remove();
    });
});
</script>
@endsection
