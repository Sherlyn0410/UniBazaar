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
                <th>Edit</th>
                <th>Delete</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>RM {{ number_format($product->product_price, 2) }}</td>
                    <td>{{ $product->product_details }}</td>
                    <td>{{ $product->student->name ?? 'No Seller' }}</td>

                    <td>
                        {{-- <a href="{{ route('edit.product', $product->id) }}" class="btn btn-sm btn-warning">Edit</a> --}}
                    </td>

                    <td>
                        {{-- <form method="POST" action="{{ route('products.destroy', $product->id) }}"> --}}
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>

                    <td>
                        <span class="badge
                            @if($product->status == 'pending') bg-warning
                            @elseif($product->status == 'live') bg-success
                            @elseif($product->status == 'out_of_stock') bg-secondary
                            @else bg-dark
                            @endif">
                            {{ ucfirst(str_replace('_', ' ', $product->status ?? 'unknown')) }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
