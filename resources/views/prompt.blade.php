<x-app-layout>
    <div class="container-fluid bg-white">
        <div class="container py-5 text-center">
            <h2 class="mb-4">✅ Thank you for your order!</h2>
            <h5>Your payment was successful.</h5>

            <div class="mt-5">
                <a href="{{ route('marketplace') }}" class="btn btn-lg btn-outline-danger me-0 me-md-3 d-block d-md-inline">Back to Marketplace</a>
                <a href="{{ route('profile', ['tab' => 'order']) }}" class="btn btn-lg btn-danger mt-3 me-md-0 d-block d-md-inline">View My Orders</a>
            </div>
        </div>
    </div>
</x-app-layout>
