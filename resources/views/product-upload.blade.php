<x-app-layout>
    <div class="container-fluid bg-white">
        <div class="container py-4">
            <div>
                <h3 class="mb-4 text-left ">Create New Product Listing</h3>
                <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="product_image" class="form-label fw-semibold">Product Image</label>
                        <input type="file" name="product_image" id="product_image" class="form-control" accept="image/*" required>
                    </div>

                    <div class="mb-3">
                        <label for="product_name" class="form-label fw-semibold">Product Name</label>
                        <input type="text" name="product_name" id="product_name" class="form-control" required>
                    </div>

                     <div class="mb-3">
                        <label for="category" class="form-label fw-semibold">Product Category</label>
                        <select id="category" class="form-select" name="category">
                            <option value="laptop">Laptop and Notebook</option>
                            <option value="accessories">Accessories</option>
                            <option value="tablets">Tablets</option>
                            <option value="mobile-phone">Mobile Phone</option>
                            <option value="video-game">Video Game Consoles</option>
                            <option value="study-material">Study Material</option>
                            <option value="stationeries">Stationeries</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label fw-semibold">Quantity</label>
                        <input type="number" step="1" name="quantity" id="quantity" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="product_price" class="form-label fw-semibold">Product Price (RM)</label>
                        <input type="number" step="0.01" name="product_price" id="product_price" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="product_details" class="form-label fw-semibold">Product Details</label>
                        <textarea name="product_details" id="product_details" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="mt-5 d-block text-end">
                        <x-red-button>
                            <i class="bi bi-plus-circle me-2"></i>
                            {{ __(' Create Listing') }}
                        </x-red-button>
                    </div>
                </form>
            </div>
        </div>       
    </div>
</x-app-layout>
