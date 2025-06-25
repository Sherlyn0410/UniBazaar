<h5 class="fw-semibold mb-3">Your Listings</h5>

<!-- Product listings will be inserted here dynamically -->
<div class="row g-3">
 <div class="container pb-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
            </div>
            <div class="overflow-auto">
                <div class="d-flex flex-row">
                    @foreach ($products as $product)
                        <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none text-dark me-3">
                            <div style="width: 200px;">
                                <img src="{{ asset($product->product_image) }}" class="card-img-top object-fit-cover border rounded mb-1" alt="{{ $product->product_name }}" style="height: 200px;" />
                                <div class="card-body">
                                    <h5 class="card-title text-truncate">{{ $product->product_name }}</h5>
                                    <h6 class="card-text">RM{{ $product->product_price }}</h6>
                                    <p class="text-truncate">
                                        <span class="badge rounded-pill text-bg-warning text-white">4.7<i class="bi bi-star-fill ms-1"></i></span>
                                        {{ $product->student->name }}
                                        <a href="{{ route('edit.product', ['product' => $product->id]) }}">Edit Product</a>
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div></div>
