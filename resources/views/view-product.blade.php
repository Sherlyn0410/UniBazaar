@extends('layouts.admin-main')

@section('content')
    <div class="container">
        <h3 class="mb-4 fw-semibold text-dark">Pending Product Listings</h3>

        @if($pendingProducts->isEmpty())
            <div class="alert alert-info">No pending products at the moment.</div>
        @else
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Seller Name</th>
                        <th>Category</th>
                        <th>Product Price</th>
                        <th>Quantity</th>
                        <th>Product Details</th>
                        <th>Approve</th>
                        <th>Reject</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pendingProducts as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->student->name ?? 'Unknown' }}</td>
                            <td>{{ ucfirst(str_replace('-', ' ', $product->category)) }}</td>
                            <td>RM {{ number_format($product->product_price, 2) }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->product_details }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.products.approve', $product) }}">
                                    @csrf
                                    <button class="btn btn-success btn-sm">Approve</button>
                                </form>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('admin.products.reject', $product) }}">
                                    @csrf
                                    <button class="btn btn-danger btn-sm">Reject</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <hr class="my-5">

        <h3 class="mb-4 fw-semibold text-dark">Approved Product Listings</h3>

        @if($approvedProducts->isEmpty())
            <div class="alert alert-info">No approved products available.</div>
        @else
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Seller Name</th>
                         <th>Category</th>
                        <th>Product Price</th>
                        <th>Quantity</th>
                        <th>Product Details</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($approvedProducts as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->student->name ?? 'No Seller' }}</td>
                            <td>{{ ucfirst(str_replace('-', ' ', $product->category)) }}</td>
                            <td>RM {{ number_format($product->product_price, 2) }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->product_details }}</td>
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
        @endif
    </div>
@endsection
