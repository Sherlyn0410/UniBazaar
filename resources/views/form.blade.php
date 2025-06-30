<x-app-layout>
    <div class="container py-5">
        <h2 class="mb-4">📝 Rate the Seller: {{ $order->product->student->name ?? 'Seller' }}</h2>

        <form action="{{ route('rate.seller.store', $order->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="rating" class="form-label">Rating (1 to 5)</label>
                <select name="rating" id="rating" class="form-select" required>
                    <option value="" disabled selected>Select a rating</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                    @endfor
                </select>
            </div>

            <div class="mb-3">
                <label for="review" class="form-label">Write a Review (optional)</label>
                <textarea name="review" id="review" class="form-control" rows="4" placeholder="Write your feedback here..."></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit Rating</button>
        </form>
    </div>
</x-app-layout>
