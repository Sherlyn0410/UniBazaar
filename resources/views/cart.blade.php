<x-app-layout>
    {{-- Gradient Header --}}
    <div class="bg-danger" style="height: 180px; background: linear-gradient(to right, #ff7c7c, #ffbaba); position: relative;">
        <div class="container h-100 d-flex align-items-center justify-content-center">
            <h2 class="text-white fw-bold">🛒 Your Shopping Cart</h2>
        </div>
    </div>

    {{-- Cart Content --}}
    <div class="container py-5">
        @if ($cartItems->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center shadow-sm">
                    <thead class="table-light">
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price (each)</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $subtotal = 0; @endphp
                        @foreach ($cartItems as $item)
                            @php
                                $price = $item->product->product_price ?? 0;
                                $total = $price * $item->quantity;
                                $subtotal += $total;
                            @endphp
                            <tr>
                                <td>{{ $item->product->product_name ?? 'Product Not Found' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>RM {{ number_format($price, 2) }}</td>
                                <td>RM {{ number_format($total, 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="bi bi-trash"></i> Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Totals --}}
            <div class="text-end mt-4">
                <h5>Subtotal: <span class="fw-bold">RM {{ number_format($subtotal, 2) }}</span></h5>
                <h4 class="text-danger fw-bold">Total: RM {{ number_format($subtotal, 2) }}</h4>
                <a href="{{ route('checkout') }}" class="btn btn-danger mt-2">Proceed to Checkout</a>
            </div>
        @else
            <div class="alert alert-info mt-5 text-center">
                Your cart is empty.
            </div>
        @endif
    </div>

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</x-app-layout>

