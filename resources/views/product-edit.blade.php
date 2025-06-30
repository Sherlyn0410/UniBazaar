<x-app-layout>
    <div class="container-fluid bg-white">
        <div class="container py-4">
            <div>
                <h3 class="mb-4 text-left">Edit Product</h3>
                <form method="POST" action="{{ route('update.product', ['product' => $product->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    {{-- Product Image --}}
                    <div class="mb-4">
                        <label for="product_image" class="form-label fw-semibold">Product Image</label>
                        <input type="file" name="product_image" id="product_image" class="form-control" accept="image/*">
                        @if($product->product_image)
                            <p class="mt-2">Current:
                                <img src="{{ asset($product->product_image) }}" width="100">
                            </p>
                        @endif
                    </div>

                    {{-- Product Name --}}
                    <div class="mb-3">
                        <label for="product_name" class="form-label fw-semibold">Product Name</label>
                        <input type="text" name="product_name" id="product_name" class="form-control"
                               value="{{ old('product_name', $product->product_name) }}" required>
                    </div>

                    {{-- Product Category --}}
                    <div class="mb-3">
                        <label for="category" class="form-label fw-semibold">Product Category</label>
                        <select id="category" class="form-select" name="category">
                            <option value="laptop" {{ $product->category === 'laptop' ? 'selected' : '' }}>Laptop and Notebook</option>
                            <option value="accessories" {{ $product->category === 'accessories' ? 'selected' : '' }}>Accessories</option>
                            <option value="tablets" {{ $product->category === 'tablets' ? 'selected' : '' }}>Tablets</option>
                            <option value="mobile-phone" {{ $product->category === 'mobile-phone' ? 'selected' : '' }}>Mobile Phone</option>
                            <option value="video-game" {{ $product->category === 'video-game' ? 'selected' : '' }}>Video Game Consoles</option>
                            <option value="study-material" {{ $product->category === 'study-material' ? 'selected' : '' }}>Study Material</option>
                            <option value="stationeries" {{ $product->category === 'stationeries' ? 'selected' : '' }}>Stationeries</option>
                        </select>
                    </div>

                    {{-- Quantity --}}
                    <div class="mb-3">
                        <label for="quantity" class="form-label fw-semibold">Quantity</label>
                        <input type="number" step="1" name="quantity" id="quantity" class="form-control"
                               value="{{ old('quantity', $product->quantity) }}" required>
                    </div>

                    {{-- Product Price --}}
                    <div class="mb-3">
                        <label for="product_price" class="form-label fw-semibold">Product Price (RM)</label>
                        <input type="number" step="0.01" name="product_price" id="product_price" class="form-control"
                               value="{{ old('product_price', $product->product_price) }}" required>
                    </div>

                    {{-- Product Details --}}
                    <div class="mb-3">
                        <label for="product_details" class="form-label fw-semibold">Product Details</label>
                        <textarea name="product_details" id="product_details" class="form-control" rows="4" required>{{ old('product_details', $product->product_details) }}</textarea>
                    </div>

                    {{-- Submit --}}
                    <div class="mt-5 d-block text-end">
                        <x-red-button>
                            <i class="bi bi-pencil-square me-2"></i>
                            {{ __(' Update Product') }}
                        </x-red-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
