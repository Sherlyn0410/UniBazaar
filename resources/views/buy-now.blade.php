<x-app-layout>
    <div class="bg-danger" style="height: 180px; background: linear-gradient(to right, #ff7c7c, #ffbaba);">
        <div class="container h-100 d-flex align-items-center justify-content-center">
            <h2 class="text-white fw-bold">🛍️ Buy Now</h2>
        </div>
    </div>

    <div class="container py-5">
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('buy.now.place') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="max_quantity" id="max_quantity" value="{{ $product->quantity }}">
            <div class="row">
                <!-- Billing Info -->
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
                    <div class="card shadow-sm mb-3">
                        <div class="card-body d-flex">
                            <img src="{{ asset($product->product_image) }}" alt="product" width="100" class="me-3">
                            <div>
                                <h5>{{ $product->product_name }}</h5>
                                <p class="text-muted mb-0">RM {{ number_format($product->product_price, 2) }}</p>
                                <p class="text-muted mb-0">Stock: {{ $product->quantity }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Quantity Selector -->
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Select Quantity</label>
                        <div class="d-flex align-items-center gap-2">
                            <button type="button" class="btn btn-outline-secondary" onclick="decreaseQuantity()">−</button>
                            <input type="number" name="quantity" id="quantity" class="form-control text-center" style="width: 80px;" value="{{ request('quantity') ?? 1 }}" min="1" max="{{ $product->quantity }}">
                            <button type="button" class="btn btn-outline-secondary" onclick="increaseQuantity()">+</button>
                        </div>
                        <small id="stock-warning" class="text-danger d-none">⚠️ Stock not enough</small>
                    </div>

                    <button type="submit" class="btn btn-danger mt-3 w-100" id="place-order-btn">Place Order</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        const maxQuantity = parseInt(document.getElementById('max_quantity').value);
        const quantityInput = document.getElementById('quantity');
        const warning = document.getElementById('stock-warning');
        const placeOrderBtn = document.getElementById('place-order-btn');

        function increaseQuantity() {
            let val = parseInt(quantityInput.value);
            if (val < maxQuantity) {
                quantityInput.value = val + 1;
                hideWarning();
            } else {
                showWarning();
            }
        }

        function decreaseQuantity() {
            let val = parseInt(quantityInput.value);
            if (val > 1) {
                quantityInput.value = val - 1;
                hideWarning();
            }
        }

        function showWarning() {
            warning.classList.remove('d-none');
            placeOrderBtn.disabled = true;
        }

        function hideWarning() {
            warning.classList.add('d-none');
            placeOrderBtn.disabled = false;
        }

        quantityInput.addEventListener('input', function () {
            let val = parseInt(this.value);
            if (val > maxQuantity) {
                showWarning();
            } else {
                hideWarning();
            }
        });
    </script>
</x-app-layout>
