<h3 class="mb-4">Ratings for {{ $student->name }}</h3>

@if ($student->receivedRatings->isEmpty())
    <div class="alert alert-info">This seller has no ratings yet.</div>
@else
    <div style="max-height: 350px; overflow-y: auto;">
        @foreach ($student->receivedRatings as $rating)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>
                        ⭐ {{ $rating->rating }}/5
                        <small class="text-muted">from {{ $rating->buyer->name ?? 'Anonymous' }}</small>
                    </h5>
                    <p class="mb-0">{{ $rating->review }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endif
