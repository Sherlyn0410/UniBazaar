<x-app-layout>
    <div class="container py-5">
        <h3 class="mb-4">Report Seller - Order #{{ $order->id }}</h3>

       <form action="{{ route('report.store', $order->id) }}" method="POST">
    @csrf
    <input type="hidden" name="buyer_id" value="{{ auth()->id() }}">
    <input type="hidden" name="seller_id" value="{{ $order->product->student_id }}">
    
    <div class="mb-3">
        <label for="reason">Reason for reporting:</label>
        <textarea name="reason" id="reason" class="form-control" required></textarea>
    </div>

    <button type="submit" class="btn btn-danger">Submit Report</button>
</form>
    </div>
</x-app-layout>
