{{-- <form method="POST" action="{{ route('ratings.store') }}">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="hidden" name="order_id" value="{{ $orderId }}"> <!-- Optional: link to order -->
    <div class="mb-2">
        <label>Rating (1 to 5):</label>
        <select name="rating" class="form-select" required>
            @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
            @endfor
        </select>
    </div>
    <div class="mb-2">
        <label>Your Review:</label>
        <textarea name="review" class="form-control" rows="3"></textarea>
    </div>
    <button class="btn btn-primary">Submit Review</button>
</form> --}}
