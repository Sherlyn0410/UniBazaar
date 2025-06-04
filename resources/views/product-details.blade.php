<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="card">
            <img src="{{ asset($product->product_image) }}" class="card-img-top" alt="{{ $product->product_name }}">
            <div class="card-body">
                <h3 class="card-title">{{ $product->product_name }}</h3>
                <h5 class="card-text">RM{{ $product->product_price }}</h5>
                <p>Sold by: {{ $product->student->name }}</p>
                <p>Description: {{ $product->product_details }}</p>
            </div>
        </div>
    </div>
</body>
</html>
