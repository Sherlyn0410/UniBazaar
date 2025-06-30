<x-app-layout>
    <div class="bg-danger" style="height: 180px; background: linear-gradient(to right, #ff7c7c, #ffbaba);">
        <div class="container h-100 d-flex align-items-center justify-content-center">
            <h2 class="text-white fw-bold">🧾 Cart Checkout</h2>
        </div>
    </div>

    <div class="container py-5">
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('stripe.checkout.pay') }}" method="POST" id="payment-form">
            @csrf

            <!-- 🛒 Order Summary -->
            <div class="card shadow-sm mb-4 p-4">
                <h5 class="fw-semibold mb-3">🧾 Order Summary</h5>
                <div class="table-responsive">
                    <table class="table table-bordered text-center mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price (each)</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $grandTotal = 0; @endphp
                            @foreach ($cartItems as $item)
                                @php
                                    $price = $item->product->product_price;
                                    $total = $price * $item->quantity;
                                    $grandTotal += $total;
                                @endphp
                                <tr>
                                    <td>{{ $item->product->product_name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>RM {{ number_format($price, 2) }}</td>
                                    <td>RM {{ number_format($total, 2) }}</td>
                                </tr>

                                <!-- Hidden for backend use -->
                                <input type="hidden" name="cart_items[{{ $item->id }}][product_id]" value="{{ $item->product_id }}">
                                <input type="hidden" name="cart_items[{{ $item->id }}][quantity]" value="{{ $item->quantity }}">
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="text-end mt-4">
                    <h5>Subtotal: <span class="fw-bold">RM {{ number_format($grandTotal, 2) }}</span></h5>
                    <h4 class="text-danger fw-bold">Total: RM {{ number_format($grandTotal, 2) }}</h4>
                    <input type="hidden" name="total" value="{{ $grandTotal }}">
                </div>
            </div>

            <!-- 🏠 Billing Address -->
            <div class="card shadow-sm mb-4 p-4">
                <h5 class="fw-bold mb-3">🏠 Billing Address</h5>
                <div class="border p-3 bg-light rounded">
                    <p class="mb-0">
                        INTI International College Penang<br>
                        1-Z, Lebuh Bukit Jambul,<br>
                        Bukit Jambul, 11900 Bayan Lepas,<br>
                        Pulau Pinang
                    </p>
                </div>
            </div>

            <!-- 💳 Payment Method -->
            <div class="card shadow-sm p-4">
                <h5 class="fw-bold mb-3">💳 Payment Method</h5>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" id="pay_stripe" value="stripe" checked>
                    <label class="form-check-label" for="pay_stripe">Pay with Card (Stripe)</label>
                </div>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="radio" name="payment_method" id="pay_in_person" value="pay_in_person">
                    <label class="form-check-label" for="pay_in_person">Pay in Person</label>
                </div>

                <div id="stripe-section" class="mt-3">
                    <label for="card-element" class="form-label">Card Info</label>
                    <div id="card-element" class="form-control"></div>
                    <div id="card-errors" class="text-danger mt-2" role="alert"></div>
                </div>

                <p class="mt-4 text-muted small">
                    By proceeding, you agree to our <a href="{{ route('privacy.policy') }}" target="_blank">Privacy Policy</a>.
                </p>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-danger px-4">
                        Pay RM {{ number_format($grandTotal, 2) }}
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ config('services.stripe.key') }}');
        const elements = stripe.elements();
        const card = elements.create('card');
        card.mount('#card-element');

        const form = document.getElementById('payment-form');
        const stripeSection = document.getElementById('stripe-section');
        const payStripe = document.getElementById('pay_stripe');
        const payInPerson = document.getElementById('pay_in_person');

        function toggleStripe() {
            stripeSection.style.display = payStripe.checked ? 'block' : 'none';
        }

        payStripe.addEventListener('change', toggleStripe);
        payInPerson.addEventListener('change', toggleStripe);
        toggleStripe();

        form.addEventListener('submit', function (e) {
            if (payStripe.checked) {
                e.preventDefault();
                stripe.createToken(card).then(result => {
                    if (result.error) {
                        document.getElementById('card-errors').textContent = result.error.message;
                    } else {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'stripeToken';
                        input.value = result.token.id;
                        form.appendChild(input);
                        form.submit();
                    }
                });
            }
        });
    </script>
</x-app-layout>
