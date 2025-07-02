<h5 class="fw-semibold mb-3">Your Listings</h5>

@if($products->isEmpty())
    <div class="alert alert-info">No listings found.</div>
@else
    <div class="table-responsive" style="max-height: 350px; overflow-y: auto;">
        <table class="table table-hover table-bordered align-middle shadow-sm rounded-4 overflow-hidden mx-auto" style="background: #fff;">
            <thead class="table-secondary align-middle">
                <tr>
                    <th class="text-center">#</th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Price (RM)</th>
                    <th>Quantity Left</th>
                    <th>Status</th>
                    <th>Buyer</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $index => $product)
                    <tr>
                        <td class="text-center fw-semibold">{{ $index + 1 }}</td>
                        <td>
                            <img src="{{ asset('/assets/img/' . $product->product_image) }}"
                                 alt="{{ $product->product_name }}"
                                 class="rounded border"
                                 style="width:48px; height:48px; object-fit:cover;">
                        </td>
                        <td class="fw-semibold">{{ $product->product_name }}</td>
                        <td>RM{{ $product->product_price }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>
                            <span class="badge 
                                @if($product->status === 'live') bg-success
                                @elseif($product->status === 'pending') bg-warning
                                @else bg-secondary
                                @endif">
                                {{ $product->status }}
                            </span>
                        </td>
                        <td>
                            @if ($product->orders->count())
                                <button class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#buyersModal{{ $product->id }}">
                                    View Buyers ({{ $product->orders->count() }})
                                </button>
                            @else
                                <span class="text-muted">No buyers</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('product.show', $product->id) }}"
                                   class="btn btn-sm btn-outline-info rounded-circle" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('edit.product', ['product' => $product->id]) }}"
                                   class="btn btn-sm btn-outline-primary rounded-circle" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('delete.product', ['product' => $product->id]) }}" method="POST" class="d-inline" onsubmit="return confirmDelete(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    {{-- 🧾 Buyer Modal --}}
                    <div class="modal fade" id="buyersModal{{ $product->id }}" tabindex="-1" aria-labelledby="buyersModalLabel{{ $product->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="buyersModalLabel{{ $product->id }}">Buyers of {{ $product->product_name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @if($product->orders->isEmpty())
                                        <p class="text-muted">No buyers yet.</p>
                                    @else
                                        <ul class="list-group">
                                            @foreach($product->orders as $order)
                                                <li class="list-group-item d-flex align-items-center gap-3">
                                                    <div>
                                                        @if($order->buyer->profile_image)
                                                            <img src="{{ asset('storage/profile_images/' . $order->buyer->profile_image) }}"
                                                                 alt="{{ $order->buyer->name }}"
                                                                 class="rounded-circle border"
                                                                 style="width:40px; height:40px; object-fit:cover;">
                                                        @else
                                                            <i class="bi bi-person-circle fs-4 text-secondary"></i>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <div><strong>{{ $order->buyer->name }}</strong> ({{ $order->buyer->email }})</div>
                                                        <div>Ordered: {{ $order->quantity }} units on {{ \Carbon\Carbon::parse($order->ordered_at)->format('d M Y, h:i A') }}</div>
                                                        <div>Contact: {{$order->buyer->contact}}</div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

<script>
function confirmDelete(event) {
    event.preventDefault();
    if (confirm('Are you sure you want to delete this product? This action cannot be undone.')) {
        event.target.submit();
    }
    return false;
}
</script>
