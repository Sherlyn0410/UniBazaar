<h2>Thanks for your order, {{ $order->buyer->name }}!</h2>

<p><strong>Product:</strong> {{ $order->product->product_name }}</p>
<p><strong>Quantity:</strong> {{ $order->quantity }}</p>
<p><strong>Total:</strong> RM {{ number_format($order->product->product_price * $order->quantity, 2) }}</p>
<p><strong>Payment ID:</strong> {{ $order->stripe_payment_id ?? 'N/A' }}</p>
<p><strong>Order Time:</strong> {{ \Carbon\Carbon::parse($order->ordered_at)->format('d M Y, h:i A') }}</p>

