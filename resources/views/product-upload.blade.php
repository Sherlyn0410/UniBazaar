<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload Product</title>
</head>
<x-app-layout>
    <div class="container">
        <form method="post" action="{{route('products.store')}}" class="my-form" enctype="multipart/form-data"
        >
            @csrf
            @method('post')
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" name="product_name" id="product_name">
            </div>

            <div class="form-group">
                <label for="product_name">Product Price</label>
                <input type="text" name="product_price" id="product_price">
            </div>

            <div class="form-group">
                <label for="product_name">Product Details</label>
                <input type="text" name="product_details" id="product_details">
            </div>

            <div class="form-group">
                <label for="product_image">Product Image</label>
                <input type="file" name="product_image" id="product_image" class="form-control" accept="image/*">
            </div>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Create Listing</button>
            </div>
        </form>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</x-app-layout>
</html>
