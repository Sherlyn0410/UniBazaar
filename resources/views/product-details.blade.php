<x-app-layout>
    <div class="container-fluid bg-white" style="min-height: 100vh;">
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-lg-4 d-flex justify-content-center mb-4 mb-lg-0">
                    <a href="javascript:history.back()" class="fs-4 text-dark me-4">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                    <img src="{{ asset('/assets/img/' . $product->product_image) }}" class="border rounded-4 object-fit-cover w-100" alt="{{ $product->product_name }}" style="max-height: 420px;">
                </div>
                <div class="col-lg-8 d-flex flex-column justify-content-between">
                    <div class="ms-3">
                        <div class="mb-2">
                            <div class="fw-semibold fs-5">{{ $product->student->name }}</div>
                        </div>
                        <hr>
                        <h3 class="fw-semibold mb-2">{{ $product->product_name }}</h3>
                        <h4 class="fw-medium mb-2">RM{{ $product->product_price }}</h4>
                    </div>

                    @php
                        $inCart = \App\Models\Cart::where('student_id', Auth::id())
                            ->where('product_id', $product->id)
                            ->exists();
                    @endphp

                    <form action="{{ route('cart.add') }}" method="POST" class="ms-4 d-flex align-items-start gap-3 flex-column">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        @php
                            $isSeller = Auth::id() === $product->student_id;
                        @endphp

                        @if ($isSeller)
                            <div class="alert alert-warning">You cannot buy your own product.</div>
                        @else
                            <div class="d-flex align-items-center gap-3">
                                <div class="d-flex align-items-center gap-2">
                                    <button type="button" class="btn btn-outline-secondary" onclick="decreaseQuantity()">−</button>
                                    <input type="number" name="quantity" id="quantity" class="form-control text-center" style="width: 80px;" value="1" min="1" max="{{ $product->quantity }}">
                                    <button type="button" class="btn btn-outline-secondary" onclick="increaseQuantity()">+</button>
                                </div>
                                <small class="text-muted">Available stock: {{ $product->quantity }}</small>
                                <small id="stock-warning" class="text-danger d-none">⚠️ Stock not enough</small>
                            </div>

                            <div>
                                @if($inCart)
                                    <x-red-outline-button class="me-3" type="button" onclick="window.location='{{ route('cart.index') }}'">
                                        <i class="bi bi-cart-check me-2"></i>
                                        {{ __('Added to Cart') }}
                                    </x-red-outline-button>
                                @else
                                    <x-red-outline-button class="me-3" type="submit">
                                        <i class="bi bi-cart-plus me-2"></i>
                                        {{ __('Add to Cart') }}
                                    </x-red-outline-button>
                                @endif

                                <x-red-button type="button" id="buy-now-btn" onclick="handleBuyNow({{ $product->id }})">
                                    <i class="bi bi-bag-check me-2"></i> Buy Now
                                </x-red-button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <div class="mb-4">
                        <h5 class="fw-semibold mb-2">Product Description</h5>
                        <p class="text-secondary">{{ $product->product_details }}</p>
                    </div>
                    <div>
                        <h5 class="fw-semibold mb-3">Seller Ratings & Reviews</h5>
                        @php
                            $ratings = $product->student->receivedRatings;
                            $average = $ratings->avg('rating');
                        @endphp
                        @if ($ratings->isEmpty())
                            <p class="text-muted">This seller has not received any reviews yet.</p>
                        @else
                            <div class="mb-3">
                                <span class="fs-5 text-warning">
                                    <i class="bi bi-star-fill"></i> {{ number_format($average, 1) }} / 5
                                </span>
                                <small class="text-muted ms-2">{{ $ratings->count() }} reviews total</small>
                            </div>
                            @foreach ($ratings as $rating)
                                <div class="card mb-3 border-0 shadow-sm bg-light">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle bg-secondary bg-opacity-25 d-flex justify-content-center align-items-center me-2" style="width: 36px; height: 36px;">
                                                    <i class="bi bi-person-fill text-secondary"></i>
                                                </div>
                                                <strong>{{ $rating->buyer->name ?? 'Anonymous' }}</strong>
                                            </div>
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($rating->created_at)->format('d M Y') }}</small>
                                        </div>
                                        <div class="mb-1">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="bi bi-star{{ $i <= $rating->rating ? '-fill text-warning' : '' }}"></i>
                                            @endfor
                                        </div>
                                        <p class="mb-0">{{ $rating->review }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>            
        </div>
    </div>
</x-app-layout>

<script>
    const maxQuantity = {{ $product->quantity }};
    const quantityInput = document.getElementById('quantity');
    const buyNowBtn = document.getElementById('buy-now-btn');

    function decreaseQuantity() {
        let value = parseInt(quantityInput.value);
        if (value > 1) quantityInput.value = value - 1;
        updateBuyNowState();
    }

    function increaseQuantity() {
        let value = parseInt(quantityInput.value);
        if (value < maxQuantity) quantityInput.value = value + 1;
        updateBuyNowState();
    }

    function showStockWarning() {
        document.getElementById('stock-warning').classList.remove('d-none');
    }

    function hideStockWarning() {
        document.getElementById('stock-warning').classList.add('d-none');
    }

    function updateBuyNowState() {
        const value = parseInt(quantityInput.value);
        if (value > maxQuantity || maxQuantity === 0) {
            buyNowBtn.disabled = true;
            showStockWarning();
        } else {
            buyNowBtn.disabled = false;
            hideStockWarning();
        }
    }

    quantityInput.addEventListener('input', updateBuyNowState);

    function handleBuyNow(productId) {
        const quantity = parseInt(quantityInput.value);
        if (quantity > 0 && quantity <= maxQuantity) {
            window.location.href = `/buy-now/${productId}?quantity=${quantity}`;
        } else {
            alert('Stock not enough.');
        }
    }

    updateBuyNowState();
</script>

