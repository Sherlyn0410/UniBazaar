 @extends('layouts.admin-main')
 
@section('content')
    <h3 class="mb-4 fw-semibold text-dark">Order List (Admin)</h3>
        @if($orders->isEmpty())
            <div class="alert alert-info">No orders found.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Buyer</th>
                            <th>Seller</th>
                            <th>Quantity</th>
                            <th>Total (RM)</th>
                            <th>Ordered At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $index => $order)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <strong>{{ $order->product->product_name }}</strong><br>
                                    {{-- <img src="{{ asset($order->product->product_image) }}" alt="product" width="60"> --}}
                                </td>
                                <td>{{ $order->buyer->name }}</td>
                                <td>{{ $order->product->student->name }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>RM {{ number_format($order->product->product_price * $order->quantity, 2) }}</td>
                                <td>{{ \Carbon\Carbon::parse($order->ordered_at)->format('d M Y, h:i A') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

@endsection
