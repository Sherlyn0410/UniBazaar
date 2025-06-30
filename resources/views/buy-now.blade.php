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

           <div class="card shadow-sm p-4 mb-4">
    <h5 class="fw-bold mb-3">🧾 Order Summary</h5>

    <div class="d-flex gap-3 align-items-start">
        <img src="{{ asset($product->product_image) }}" width="100" class="rounded border" alt="Product Image">

        <div class="flex-grow-1">
            <h5 class="mb-1">{{ $product->product_name }}</h5>
            <p class="mb-1 text-muted">Price per unit: RM {{ number_format($product->product_price, 2) }}</p>
            <p class="mb-1 text-muted">Quantity: {{ request('quantity') ?? 1 }}</p>
            <hr>
            <p class="fw-bold fs-5 mb-0">
                Total: RM {{ number_format($product->product_price * (request('quantity') ?? 1), 2) }}
            </p>
        </div>
    </div>
</div>


            <div class="mt-5">
                <h5 class="fw-bold mb-3">Billing Address</h5>
                <div class="border p-3 bg-light rounded">
                    <p class="mb-0">INTI International College Penang<br>1-Z, Lebuh Bukit Jambul,<br>Bukit Jambul, 11900 Bayan Lepas,<br>Pulau Pinang</p>
                </div>
            </div>

            <div class="mt-5">
                <h5 class="fw-bold mb-3">Payment Method</h5>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" id="pay_stripe" value="stripe" checked>
                    <label class="form-check-label" for="pay_stripe">Pay with Card (Stripe)</label>
                </div>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="radio" name="payment_method" id="pay_in_person" value="pay_in_person">
                    <label class="form-check-label" for="pay_in_person">Pay in Person</label>
                </div>

                <div id="stripe-section" class="mt-3">
                    <label for="card-element">Card Info</label>
                    <div id="card-element" class="form-control"></div>
                    <div id="card-errors" class="text-danger mt-2" role="alert"></div>
                </div>
            </div>

            <p class="mt-4 text-muted small">
                By proceeding, you agree to our <a href="{{ route('privacy.policy') }}" target="_blank">Privacy Policy</a>.
            </p>

            <div class="text-end mt-4">
                <button type="submit" class="btn btn-danger px-4">
                    Pay RM {{ number_format($product->product_price * (request('quantity') ?? 1), 2) }}
                </button>
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


