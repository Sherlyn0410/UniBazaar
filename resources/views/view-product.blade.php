@extends('layouts.admin-main')

@section('content')
    <h3 class="mb-4 fw-semibold text-dark">List of Products</h3>
    
    <table class="table table-striped table-bordered align-middle mx-auto">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Product Details</th>
                <th>Seller Name</th>
                <th>Action</th>
                <th>Action</th>
            </tr>
        </thead>

        @foreach ($products as $product)
            <tr>
                <td>{{$product ->id}}</td>
                <td>{{$product ->product_name}}</td>
                <td> {{$product ->product_price}}</td>
                <td>{{$product ->product_details}}</td>
                <td>{{ $product->student->name ?? 'No Seller' }}</td>


                <td><a href="" class="btn btn-sm btn-warning">Edit</a></td>
                <td>
                    <form method="post" action="">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Delete" class="btn btn-sm btn-danger">

                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
