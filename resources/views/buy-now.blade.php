<x-app-layout>
    <div class="bg-danger" style="height: 180px; background: linear-gradient(to right, #ff7c7c, #ffbaba);">
        <div class="container h-100 d-flex align-items-center justify-content-center">
            <h2 class="text-white fw-bold">🛍️ Buy Now</h2>
        </div>
    </div>

    <div class="container py-5">
        <form action="{{ route('buy.now.place') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="row">
                <!-- Billing Details -->
                <div class="col-md-6">
                    <h5 class="fw-bold mb-3">Billing Info</h5>
                    <div class="mb-3">
                        <label>Full Name</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label>Address</label>
                        <textarea name="address" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Payment Method</label>
                        <select name="payment_method" class="form-select" required>
                            <option value="COD">Cash on Delivery</option>
                            <option value="Online">Online Payment</option>
                        </select>
                    </div>
                </div>

                <!-- Product Summary -->
                <div class="col-md-6">
                    <h5 class="fw-bold mb-3">Product Summary</h5>
                    <div class="card shadow-sm">
                        <div class="card-body d-flex">
                            <img src="{{ asset($product->product_image) }}" alt="product" width="100" class="me-3">
                            <div>
                                <h5>{{ $product->product_name }}</h5>
                                <p class="text-muted mb-0">RM {{ number_format($product->product_price, 2) }}</p>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger mt-4 w-100">Place Order</button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
