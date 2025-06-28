<x-app-layout>
    <div class="container py-5">
        <h3 class="mb-4">🧾 Cart Checkout</h3>

        <form action="{{ route('stripe.checkout.pay') }}" method="POST" id="payment-form">
            @csrf

            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
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

                        {{-- pass to backend --}}
                        <input type="hidden" name="cart_items[{{ $item->id }}][product_id]" value="{{ $item->product_id }}">
                        <input type="hidden" name="cart_items[{{ $item->id }}][quantity]" value="{{ $item->quantity }}">
                    @endforeach
                </tbody>
            </table>

            <h4 class="text-end">Total: RM {{ number_format($grandTotal, 2) }}</h4>

            <div class="mb-3">
                <label for="card-element" class="form-label">Card Information</label>
                <div id="card-element" class="form-control"></div>
                <div id="card-errors" class="text-danger mt-2" role="alert"></div>
            </div>

            <input type="hidden" name="total" value="{{ $grandTotal }}">

            <button type="submit" class="btn btn-primary">Pay RM {{ number_format($grandTotal, 2) }}</button>
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
                    const hidden = document.createElement('input');
                    hidden.setAttribute('type', 'hidden');
                    hidden.setAttribute('name', 'stripeToken');
                    hidden.setAttribute('value', result.token.id);
                    form.appendChild(hidden);
                    form.submit();
                }
            });
        });
    </script>
</x-app-layout>
