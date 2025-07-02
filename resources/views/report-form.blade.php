<x-app-layout>
    <div class="container-fluid bg-white">
        <div class="container py-4">
            <h3 class="mb-4">
                Report Seller - Order #{{ $index ?? $order->id }}
            </h3>
            <form action="{{ route('report.store', $order->id) }}" method="POST">
                @csrf
                <input type="hidden" name="buyer_id" value="{{ auth()->id() }}">
                <input type="hidden" name="seller_id" value="{{ $order->product->student_id }}">
                
                <div class="mb-3">
                    <label for="reason">Reason for reporting:</label>
                    <textarea name="reason" id="reason" class="form-control" required></textarea>
                </div>

                <div class="d-block text-end mt-5">
                    <a href="{{ route('profile', ['tab' => 'order']) }}" class="text-decoration-none me-2">
                        <x-red-outline-button>Cancel</x-red-outline-button>
                    </a>
                    <x-red-button>Submit Report</x-red-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
