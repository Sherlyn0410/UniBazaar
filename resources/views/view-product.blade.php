@extends('layouts.admin-main')

@section('content')
    <h3 class="mb-4 fw-semibold text-dark">Pending Product Listings</h3>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($pendingProducts->isEmpty())
        <div class="alert alert-info">No pending products at the moment.</div>
    @else
        <div class="table-responsive" style="max-height: 300px; overflow: auto;">
            <table class="table table-striped table-hover table-bordered align-middle shadow-sm rounded-4 overflow-hidden mx-auto" style="background: #fff; min-width: 900px;">
                <thead class="table-secondary align-middle">
                    <tr>
                        <th class="text-center">#</th>
                        <th>Product</th>
                        <th>Seller Name</th>
                        <th>Category</th>
                        <th>Product Price</th>
                        <th>Quantity</th>
                        <th>Product Details</th>
                        <th class="text-center">Approve</th>
                        <th class="text-center">Reject</th>
                    </tr>
                </thead>
                <tbody class="align-top">
                    @foreach ($pendingProducts as $index => $product)
                        <tr>
                            <td class="text-center fw-semibold">{{ $index + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-start gap-2">
                                    @if(!empty($product->product_image) && file_exists(public_path('assets/img/' . $product->product_image)))
                                        <img src="{{ asset('assets/img/' . $product->product_image) }}"
                                             alt="{{ $product->product_name }}"
                                             class="rounded shadow-sm"
                                             style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                        <span class="bg-secondary text-white rounded d-flex justify-content-center align-items-center"
                                              style="width:40px; height:40px;">
                                            <i class="bi bi-image"></i>
                                        </span>
                                    @endif
                                    <span class="fw-semibold">{{ $product->product_name }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if(!empty($product->student->profile_image) && file_exists(public_path('assets/img/' . $product->student->profile_image)))
                                        <img src="{{ asset('assets/img/' . $product->student->profile_image) }}"
                                             alt="{{ $product->student->name ?? 'Seller' }}"
                                             class="rounded-circle shadow-sm"
                                             style="width: 32px; height: 32px; object-fit: cover;">
                                    @else
                                        <span class="bg-secondary text-white rounded-circle d-flex justify-content-center align-items-center"
                                              style="width:32px; height:32px;">
                                            <i class="bi bi-person"></i>
                                        </span>
                                    @endif
                                    <span>{{ $product->student->name ?? 'Unknown' }}</span>
                                </div>
                            </td>
                            <td>{{ ucfirst(str_replace('-', ' ', $product->category)) }}</td>
                            <td>RM {{ number_format($product->product_price, 2) }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td class="text-muted">{{ $product->product_details }}</td>
                            <td class="text-center">
                                <form method="POST" action="{{ route('admin.products.approve', $product) }}" class="approve-form d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm rounded-circle" title="Approve">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="text-center">
                                <form method="POST" action="{{ route('admin.products.reject', $product) }}" class="reject-form d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm rounded-circle" title="Reject">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <hr class="my-4">

    <h3 class="mb-4 fw-semibold">Approved Product Listings</h3>

    @if($approvedProducts->isEmpty())
        <div class="alert alert-info">No approved products available.</div>
    @else
        <div class="table-responsive" style="max-height: 300px; overflow: auto;">
            <table class="table table-striped table-hover table-bordered align-middle shadow-sm rounded-4 overflow-hidden mx-auto" style="background: #fff; min-width: 900px;">
                <thead class="table-secondary align-middle">
                    <tr>
                        <th class="text-center">#</th>
                        <th>Product</th>
                        <th>Seller Name</th>
                        <th>Category</th>
                        <th>Product Price</th>
                        <th>Quantity</th>
                        <th>Product Details</th>
                        <th>Status</th>
                        <th class="text-center">Delete</th>
                    </tr>
                </thead>
                <tbody class="align-top">
                    @foreach ($approvedProducts as $index => $product)
                        <tr>
                            <td class="text-center fw-semibold">{{ $index + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-start gap-2">
                                    @if(!empty($product->product_image) && file_exists(public_path('assets/img/' . $product->product_image)))
                                        <img src="{{ asset('assets/img/' . $product->product_image) }}"
                                             alt="{{ $product->product_name }}"
                                             class="rounded shadow-sm"
                                             style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                        <span class="bg-secondary text-white rounded d-flex justify-content-center align-items-center"
                                              style="width:40px; height:40px;">
                                            <i class="bi bi-image"></i>
                                        </span>
                                    @endif
                                    <span class="fw-semibold">{{ $product->product_name }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if(!empty($product->student->profile_image) && file_exists(public_path('assets/img/' . $product->student->profile_image)))
                                        <img src="{{ asset('assets/img/' . $product->student->profile_image) }}"
                                             alt="{{ $product->student->name ?? 'Seller' }}"
                                             class="rounded-circle shadow-sm"
                                             style="width: 32px; height: 32px; object-fit: cover;">
                                    @else
                                        <span class="bg-secondary text-white rounded-circle d-flex justify-content-center align-items-center"
                                              style="width:32px; height:32px;">
                                            <i class="bi bi-person"></i>
                                        </span>
                                    @endif
                                    <span>{{ $product->student->name ?? 'Unknown' }}</span>
                                </div>
                            </td>
                            <td>{{ ucfirst(str_replace('-', ' ', $product->category)) }}</td>
                            <td>RM {{ number_format($product->product_price, 2) }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td class="text-muted">{{ $product->product_details }}</td>
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
                            <td class="text-center">
                                <form method="POST" action="{{ route('admin.products.delete', $product) }}" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm rounded-circle" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Approve button with processing alert
        document.querySelectorAll('.approve-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Processing',
                    text: 'Approving product...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                form.submit();
            });
        });

        // Reject button with confirm and processing alert
        document.querySelectorAll('.reject-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This will reject the product listing. Are you sure?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, reject it!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Processing',
                            text: 'Rejecting product...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
