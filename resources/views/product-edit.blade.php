
<form action="{{ route('update.product', ['product' => $product->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
<input type="hidden" name="_method" value="PUT">
    <!-- Hidden product ID -->
    <input type="hidden" name="product_id" value="{{ $product->id }}">

    <!-- Product Name -->
    <div class="form-group">
        <label for="product_name">Product Name</label>
        <input type="text" class="form-control" id="product_name" name="product_name"
               value="{{ old('product_name', $product->product_name) }}" required>
    </div>

    <!-- Product Price -->
    <div class="form-group">
        <label for="product_price">Product Price (RM)</label>
        <input type="number" step="0.01" class="form-control" id="product_price" name="product_price"
               value="{{ old('product_price', $product->product_price) }}" required>
    </div>

    <!-- Product Image -->
    <div class="form-group">
        <label for="product_image">Product Image</label>
        <input type="file" class="form-control-file" id="product_image" name="product_image">
        @if($product->product_image)
            <p>Current: <img src="{{ asset('storage/product_images/' . $product->product_image) }}" width="100"></p>
        @endif
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Update Product</button>
</form>
