@extends('layouts.admin-main')

@section('content')
    <h3 class="fw-semibold mb-4">Reported Sellers</h3>

    @if ($reports->isEmpty())
        <div class="alert alert-info">No reports submitted.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered align-top shadow-sm rounded-4 overflow-hidden mx-auto" style="background: #fff;">
                <thead class="table-secondary align-top">
                    <tr>
                        <th class="text-center">#</th>
                        <th>Buyer</th>
                        <th>Seller</th>
                        <th>Product</th>
                        <th>Reason</th>
                        <th>Reported At</th>
                        <th class="text-center">Ban Seller</th>
                    </tr>
                </thead>
                <tbody class="align-top">
                    @foreach ($reports as $index => $report)
                        <tr>
                            <td class="text-center fw-semibold">{{ $index + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if(!empty($report->buyer->profile_image) && file_exists(public_path('assets/img/' . $report->buyer->profile_image)))
                                        <img src="{{ asset('assets/img/' . $report->buyer->profile_image) }}"
                                             alt="{{ $report->buyer->name }}"
                                             class="rounded-circle shadow-sm"
                                             style="width: 32px; height: 32px; object-fit: cover;">
                                    @else
                                        <span class="bg-secondary text-white rounded-circle d-flex justify-content-center align-items-center"
                                              style="width:32px; height:32px;">
                                            <i class="bi bi-person"></i>
                                        </span>
                                    @endif
                                    <span>{{ $report->buyer->name ?? 'N/A' }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if(!empty($report->seller->profile_image) && file_exists(public_path('assets/img/' . $report->seller->profile_image)))
                                        <img src="{{ asset('assets/img/' . $report->seller->profile_image) }}"
                                             alt="{{ $report->seller->name }}"
                                             class="rounded-circle shadow-sm"
                                             style="width: 32px; height: 32px; object-fit: cover;">
                                    @else
                                        <span class="bg-secondary text-white rounded-circle d-flex justify-content-center align-items-center"
                                              style="width:32px; height:32px;">
                                            <i class="bi bi-person"></i>
                                        </span>
                                    @endif
                                    <span>{{ $report->seller->name ?? 'N/A' }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-start gap-2">
                                    @if(!empty($report->order->product->product_image) && file_exists(public_path('assets/img/' . $report->order->product->product_image)))
                                        <img src="{{ asset('assets/img/' . $report->order->product->product_image) }}"
                                             alt="{{ $report->order->product->product_name }}"
                                             class="rounded shadow-sm"
                                             style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                        <span class="bg-secondary text-white rounded d-flex justify-content-center align-items-center"
                                              style="width:40px; height:40px;">
                                            <i class="bi bi-image"></i>
                                        </span>
                                    @endif
                                    <span class="fw-semibold">{{ $report->order->product->product_name ?? 'N/A' }}</span>
                                </div>
                            </td>
                            <td class="text-muted">{{ $report->reason }}</td>
                            <td>{{ $report->created_at->format('d M Y, h:i A') }}</td>
                            <td class="text-center">
                                <form action="{{ route('admin.student.delete', $report->seller->id) }}" method="POST" class="ban-seller-form">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Ban Seller</button>
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
        // Ban seller with confirm and processing alert
        document.querySelectorAll('.ban-seller-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This will ban the seller and delete all their products.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, ban seller!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Processing',
                            text: 'Banning seller...',
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
