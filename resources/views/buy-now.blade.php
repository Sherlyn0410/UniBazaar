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

        <form action="{{ route('stripe.checkout.pay') }}" method="POST" id="payment-form">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" value="{{ request('quantity') ?? 1 }}">
            <input type="hidden" name="total" value="{{ $product->product_price * (request('quantity') ?? 1) }}">

            <!-- 🧾 Order Summary -->
            <div class="card shadow-sm mb-4 p-4">
                <h5 class="fw-semibold mb-3">🧾 Order Summary</h5>
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex align-items-center border rounded-3 p-3 bg-light">
                        @if($product && $product->product_image)
                            <img src="{{ asset('/assets/img/' . $product->product_image) }}"
                                 alt="{{ $product->product_name }}"
                                 class="rounded border me-3"
                                 style="width:64px; height:64px; object-fit:cover;">
                        @else
                            <span class="text-muted me-3 d-flex align-items-center justify-content-center"
                                  style="width:64px; height:64px; background:#f0f0f0; border-radius:8px;">
                                <i class="bi bi-image fs-2"></i>
                            </span>
                        @endif
                        <div class="flex-grow-1">
                            <div class="fw-semibold">{{ $product->product_name }}</div>
                            <div class="text-muted small">{{ $product->category ?? '' }}</div>
                            <div class="mt-1">
                                <span class="ms-0">Price: <span class="fw-semibold">RM {{ number_format($product->product_price, 2) }}</span></span>
                            </div>
                        </div>
                        <div class="text-end ms-3">
                            <span class="badge bg-secondary mb-1">Qty: {{ request('quantity') ?? 1 }}</span>
                            <div class="fw-bold text-danger text-nowrap">RM {{ number_format($product->product_price * (request('quantity') ?? 1), 2) }}</div>
                        </div>
                    </div>
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
                <div id="stripe-section" class="mt-3">
                    <label for="card-element" class="form-label">Card Info</label>
                    <div id="card-element" class="form-control"></div>
                    <div id="card-errors" class="text-danger mt-2" role="alert"></div>
                </div>
                <p class="mt-4 text-muted small">
                    By proceeding, you agree to our <a href="{{ route('privacy.policy') }}">Privacy Policy</a>.
                </p>
            </div>

            <div style="height: 80px;"></div>
            {{-- Spacer to prevent content from being hidden behind sticky bar --}}

            <!-- Sticky Bottom Bar -->
            <div class="bg-white border-top shadow-lg py-3 px-4 d-flex align-items-center justify-content-end fixed-bottom" style="z-index:1050;">
                <div class="text-end me-4">
                    <h6 class="mb-1">Subtotal: <span class="fw-bold">RM {{ number_format($product->product_price * (request('quantity') ?? 1), 2) }}</span></h6>
                    <h5 class="text-danger fw-bold mb-0">Total: RM {{ number_format($product->product_price * (request('quantity') ?? 1), 2) }}</h5>
                    <input type="hidden" name="total" value="{{ $product->product_price * (request('quantity') ?? 1) }}">
                </div>
                <button type="submit" form="payment-form" class="btn btn-danger btn-lg">
                    Pay Now
                </button>
            </div>
        </form>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const stripe = Stripe('{{ config('services.stripe.key') }}');
        const elements = stripe.elements();
        const card = elements.create('card');
        card.mount('#card-element');

        const form = document.getElementById('payment-form');
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Processing Payment',
                text: 'Please wait while we process your payment...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            stripe.createToken(card).then(result => {
                if (result.error) {
                    Swal.close();
                    document.getElementById('card-errors').textContent = result.error.message;
                } else {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'stripeToken';
                    hiddenInput.value = result.token.id;
                    form.appendChild(hiddenInput);
                    form.submit();
                }
            });
        });
    </script>
</x-app-layout>


