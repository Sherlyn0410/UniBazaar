<x-app-layout>
    <div class="container py-5 text-center">
        <h2 class="mb-4">✅ Thank you for your order!</h2>
        <p>Would you like to leave a rating for the seller?</p>

        <div class="mt-4">
            <a href="{{ route('rate.seller.form', $order->id) }}" class="btn btn-success me-3">Yes, Rate Now</a>
            <a href="{{ route('marketplace') }}" class="btn btn-secondary">Maybe Later</a>
        </div>
    </div>
</x-app-layout>
