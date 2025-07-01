<h5 class="fw-semibold mb-3">Order History</h5>

<!-- Order table will be populated dynamically -->
<table class="table table-striped table-bordered">
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
                            <th>Quantity</th>
                            <th>Total (RM)</th>
                            <th>Ordered At</th>
                            <th>Action</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $index => $order)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <strong>{{ $order->product->product_name }}</strong><br>
                                    <img src="{{ asset($order->product->product_image) }}" alt="product" width="60">
                                </td>
                                <td>{{ $order->buyer->name }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>RM {{ number_format($order->product->product_price * $order->quantity, 2) }}</td>
                                <td>{{ \Carbon\Carbon::parse($order->ordered_at)->format('d M Y, h:i A') }}</td>
                                <td>
                                    <a href="{{ route('rate.seller.form', ['order' => $order->id]) }}" class="btn btn-sm btn-primary">
                                        Rate Seller
                                    </a>
                                </td>       
                                <td>
                                    <a href="{{ route('report.create', $order) }}" class="btn btn-sm btn-danger">Report Seller</a>
                                </td>                         
                            </tr>
                           
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
</table>
