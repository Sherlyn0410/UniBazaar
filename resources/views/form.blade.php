<x-app-layout>
    <div class="container-fluid bg-white">
        <div class="container py-4">
            <h3 class="mb-4 text-left">Rate the Seller: {{ $order->product->student->name ?? 'Seller' }}</h3>

            {{-- Flash Messages --}}
                @if(session('success'))
                    <div class="alert alert-success mt-4">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger mt-4">{{ session('error') }}</div>
                @endif

            <form method="POST" action="{{ route('rate.seller.store', $order->id) }}">
                @csrf

                {{-- Rating Dropdown --}}
                <div class="mb-4">
                    <label for="rating" class="form-label fw-semibold">Rating (1 to 5)</label>
                    <select name="rating" id="rating" class="form-select" required>
                        <option value="" disabled selected>Select a rating</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                        @endfor
                    </select>
                </div>

                {{-- Review Textarea --}}
                <div class="mb-3">
                    <label for="review" class="form-label fw-semibold">Write a Review (optional)</label>
                    <textarea name="review" id="review" class="form-control" rows="4" placeholder="Write your feedback here..."></textarea>
                </div>

                {{-- Cancel & Submit Button --}}
                <div class="mt-5 d-block text-end">
                    <a href="{{ route('profile', ['tab' => 'order']) }}" class="text-decoration-none me-2">
                        <x-red-outline-button>Cancel</x-red-outline-button>
                    </a>
                    <x-red-button>
                        {{ __('Submit Rating') }}
                    </x-red-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
