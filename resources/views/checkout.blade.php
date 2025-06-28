<x-app-layout>
    <div class="container py-5">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <h4>Product: {{ $product->product_name }}</h4>
        <h5>Price: RM {{ number_format($product->product_price, 2) }}</h5>
        <h5>Quantity: {{ request('quantity') ?? 1 }}</h5>
        <h5>Total: RM {{ number_format($product->product_price * (request('quantity') ?? 1), 2) }}</h5>

        <form action="{{ route('stripe.charge') }}" method="POST" id="payment-form">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" value="{{ request('quantity') ?? 1 }}">

            <div class="mb-3">
                <label for="card-element" class="form-label">Card Information</label>
                <div id="card-element" class="form-control"></div>
                <div id="card-errors" class="text-danger mt-2" role="alert"></div>
            </div>

            <button class="btn btn-primary">Pay Now</button>
        </form>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ config('services.stripe.key') }}');
        const elements = stripe.elements();
        const card = elements.create('card');
        card.mount('#card-element');

        const form = document.getElementById('payment-form');
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            stripe.createToken(card).then(function (result) {
                if (result.error) {
                    document.getElementById('card-errors').textContent = result.error.message;
                } else {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', result.token.id);
                    form.appendChild(hiddenInput);
                    form.submit();
                }
            });
        });
    </script>
</x-app-layout>
