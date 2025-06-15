<x-app-layout>
  <div class="container">
    <h2>Your Cart</h2>

    @if ($cartItems->count() > 0)
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price (each)</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                    <tr>
                        <td>{{ $item->product->product_name ?? 'Product Not Found' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>RM {{ number_format($item->product->product_price ?? 0, 2) }}</td>
                        <td>RM {{ number_format(($item->product->product_price ?? 0) * $item->quantity, 2) }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
</x-app-layout>
