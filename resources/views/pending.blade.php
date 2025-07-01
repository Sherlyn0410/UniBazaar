
    <div class="container py-5">
        <h3 class="mb-4">📝 Pending Product Listings</h3>

        @if ($products->isEmpty())
            <div class="alert alert-info">No pending products at the moment.</div>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Student</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Action</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->student->name ?? 'Unknown' }}</td>
                            <td>{{ $product->category }}</td>
                            <td>RM {{ number_format($product->product_price, 2) }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.products.approve', $product) }}">
                                    @csrf
                                    <button class="btn btn-success btn-sm">Approve</button>
                                </form>
                            <td>
                                <form method="POST" action="{{ route('admin.products.reject', $product) }}">
                                    @csrf
                                    <button class="btn btn-danger btn-sm">Reject</button>
                                </form>
                            </td>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
