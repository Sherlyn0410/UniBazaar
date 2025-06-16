<x-app-layout>
    {{-- Gradient Header (Same as Cart Page) --}}
    <div class="bg-danger" style="height: 180px; background: linear-gradient(to right, #ff7c7c, #ffbaba); position: relative;">
        <div class="container h-100 d-flex align-items-center justify-content-center">
            <h2 class="text-white fw-bold">🧾 Checkout</h2>
        </div>
    </div>

    <div class="container py-5">
        <form action="{{ route('checkout.place') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Billing Details -->
                <div class="col-md-6 mb-4">
                    <h5 class="mb-3 fw-bold">Billing Details</h5>
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" required value="{{ old('name', Auth::user()->name ?? '') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="3" required>{{ old('address') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" required value="{{ old('phone') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Payment Method</label>
                        <select name="payment_method" class="form-select" required>
                            <option value="COD">Cash on Delivery</option>
                            <option value="Online">Online Payment</option>
                        </select>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-md-6 mb-4">
                    <h5 class="mb-3 fw-bold">Order Summary</h5>
                    @php $subtotal = 0; @endphp
                    <ul class="list-group">
                        @foreach ($cartItems as $item)
                            @php
                                $price = $item->product->product_price ?? 0;
                                $total = $price * $item->quantity;
                                $subtotal += $total;
                            @endphp
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $item->product->product_name ?? 'Product Not Found' }} × {{ $item->quantity }}
                                <span>RM {{ number_format($total, 2) }}</span>
                            </li>
                        @endforeach
                        <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                            Total
                            <span class="text-danger">RM {{ number_format($subtotal, 2) }}</span>
                        </li>
                    </ul>
                    <button type="submit" class="btn btn-danger mt-4 w-100">
                        <i class="bi bi-bag-check"></i> Place Order
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</x-app-layout>

