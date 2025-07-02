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
                        <td>
                            <span class="fw-semibold">{{ $product->product_name }}</span>
                        </td>
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
                            <div class="d-flex align-items-center gap-2">
                                @if($product->buyer && $product->buyer->profile_image)
                                    <img src="{{ asset('storage/profile_images/' . $product->buyer->profile_image) }}"
                                         alt="{{ $product->buyer->name }}"
                                         class="rounded-circle border"
                                         style="width:24px; height:24px; object-fit:cover;">
                                @else
                                    <span class="bg-secondary text-white rounded-circle d-flex justify-content-center align-items-center"
                                          style="width:24px; height:24px;">
                                        <i class="bi bi-person-fill"></i>
                                    </span>
                                @endif
                                <span>{{ $product->buyer->name ?? '-' }}</span>
                            </div>
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
                @endforeach
            </tbody>
        </table>
    </div>
@endif

{{-- Add this script at the bottom of your file or in a @push('scripts') section --}}
<script>
function confirmDelete(event) {
    event.preventDefault();
    if (confirm('Are you sure you want to delete this product? This action cannot be undone.')) {
        event.target.submit();
    }
    return false;
}
</script>
