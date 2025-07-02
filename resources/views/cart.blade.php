<x-app-layout>
    <div class="bg-danger" style="height: 180px; background: linear-gradient(to right, #ff7c7c, #ffbaba); position: relative;">
        <div class="container h-100 d-flex align-items-center justify-content-center">
            <h2 class="text-white fw-bold">🛒 Your Shopping Cart</h2>
        </div>
    </div>
    <div class="container-fluid bg-white">
        <div class="container py-5">
            {{-- Alerts --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($cartItems->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered align-middle text-center shadow-sm rounded-4 overflow-hidden mx-auto" style="background: #fff;">
                        <thead class="table-secondary align-middle">
                            <tr>
                                <!-- Checkbox column -->
                                <th style="width:40px;"></th> 
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
                                    <td>
                                        <input type="checkbox" name="selected_items[]" value="{{ $item->id }}" form="checkout-form">
                                    </td>
                                    <td>
                                        <a href="{{ route('product.show', $item->product->id) }}" class="d-flex align-items-center text-decoration-none text-dark">
                                            @if($item->product && $item->product->product_image)
                                                <img src="{{ asset('/assets/img/' . $item->product->product_image) }}"
                                                     alt="{{ $item->product->product_name }}"
                                                     class="rounded border me-2"
                                                     style="width:56px; height:56px; object-fit:cover;">
                                            @else
                                                <span class="text-muted me-2" style="width:56px; height:56px; display:inline-block; background:#f0f0f0; border-radius:8px;"></span>
                                            @endif
                                            <span class="fw-semibold">{{ $item->product->product_name ?? 'Product Not Found' }}</span>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('cart.updateQuantity', $item->id) }}" method="POST" class="d-flex justify-content-center align-items-center gap-2">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->quantity }}" class="form-control form-control-sm item-qty" style="width: 70px;" data-qty="{{ $item->quantity }}">
                                            <button type="submit" class="btn btn-sm btn-outline-primary" title="Update Quantity">
                                                <i class="bi bi-check2-circle"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="item-price" data-price="{{ $price }}">RM {{ number_format($price, 2) }}</td>
                                    <td>RM {{ number_format($total, 2) }}</td>
                                    <td>
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm" title="Remove from Cart">
                                                <i class="bi bi-trash"></i>
                                            </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- Sticky Checkout Bar --}}
                <form id="checkout-form" action="{{ route('cart.checkout') }}" method="GET">
                    @csrf
                    <div class="checkout-bar bg-white border-top shadow-lg py-3 px-4 d-flex align-items-center justify-content-end fixed-bottom" id="checkout-bar" style="display:none;">
                        <div class="me-4 text-end">
                            <h6 class="mb-0">
                                Subtotal: <span class="fw-bold" id="subtotal-text">RM 0.00</span>
                            </h6>
                            <h5 class="text-danger fw-bold mb-0">
                                Total: RM <span id="total-text">0.00</span>
                            </h5>
                        </div>
                        <x-red-button class="btn-lg" id="checkout-selected-btn">
                            Checkout Now (<span id="selected-count">0</span>)
                        </x-red-button>
                    </div>
                </form>
                <div style="height: 110px;"></div>
                {{-- Spacer to prevent content from being hidden behind sticky bar --}}
            @else
                <div class="alert alert-info mt-5 text-center">Your cart is empty.</div>
            @endif
        </div>
    </div>
    

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</x-app-layout>

<script>
document.addEventListener('DOMContentLoaded', function () {
    function updateSelectedCountAndTotals() {
        const checkboxes = document.querySelectorAll('input[name="selected_items[]"]');
        let count = 0;
        let subtotal = 0;

        checkboxes.forEach(function (checkbox) {
            if (checkbox.checked) {
                count++;
                // Get the row and price/quantity info
                const row = checkbox.closest('tr');
                const price = parseFloat(row.querySelector('.item-price').dataset.price);
                const qty = parseInt(row.querySelector('.item-qty').dataset.qty);
                subtotal += price * qty;
            }
        });

        // Format number as currency (e.g., 1,234.56)
        function formatCurrency(num) {
            return num.toLocaleString('en-MY', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        }

        document.getElementById('selected-count').textContent = count;
        document.getElementById('subtotal-text').textContent = 'RM ' + formatCurrency(subtotal);
        document.getElementById('total-text').textContent = formatCurrency(subtotal);

        // Show/hide checkout bar
        document.getElementById('checkout-bar').style.display = count > 0 ? 'flex' : 'none';
    }

    // Initial count and totals
    updateSelectedCountAndTotals();

    // Listen for changes on all checkboxes
    document.querySelectorAll('input[name="selected_items[]"]').forEach(function (checkbox) {
        checkbox.addEventListener('change', updateSelectedCountAndTotals);
    });
});
</script>
