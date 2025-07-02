<h5 class="fw-semibold mb-3">Order History</h5>

@if($orders->isEmpty())
    <div class="alert alert-info rounded-3 shadow-sm">No orders found.</div>
@else
    <div class="table-responsive" style="max-height: 350px; overflow-y: auto;">
        <table class="table table-hover table-bordered align-middle shadow-sm rounded-4 overflow-hidden mx-auto" style="background: #fff;">
            <thead class="table-secondary align-middle">
                <tr>
                    <th class="text-center">#</th>
                    <th>Product</th>
                    <th>Seller</th>
                    <th>Quantity</th>
                    <th>Total (RM)</th>
                    <th>Ordered At</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $index => $order)
                    <tr>
                        <td class="text-center fw-semibold">{{ $index + 1 }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                @if($order->product && $order->product->product_image)
                                    <img src="{{ asset('/assets/img/' . $order->product->product_image) }}"
                                         alt="{{ $order->product->product_name }}"
                                         class="rounded border"
                                         style="width:48px; height:48px; object-fit:cover;">
                                @else
                                    <span class="text-muted d-inline-block" style="width:48px; height:48px; background:#f0f0f0; border-radius:8px;"></span>
                                @endif
                                <span class="fw-semibold">{{ $order->product->product_name }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <span>{{ $order->product->student->name ?? '-' }}</span>
                                @php
                                    $seller = $order->product->student ?? null;
                                    $rating = $seller && $seller->receivedRatings->count() > 0
                                        ? number_format($seller->receivedRatings->avg('rating'), 1)
                                        : null;
                                @endphp
                                @if($rating)
                                    <span class="badge bg-warning text-white d-flex align-items-center gap-1">
                                        <i class="bi bi-star-fill text-white"></i>
                                        {{ $rating }}
                                    </span>
                                @else
                                    <span class="badge bg-secondary">No rating</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            {{ $order->quantity }}
                        </td>
                        <td>
                            <span class="fw-bold text-danger">RM {{ number_format($order->product->product_price * $order->quantity, 2) }}</span>
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($order->ordered_at)->format('d M Y, h:i A') }}
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('rate.seller.form', ['order' => $order->id]) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                    <i class="bi bi-star"></i> Rate Seller
                                </a>
                                <a href="{{ route('report.create', ['order' => $order->id, 'index' => $index + 1]) }}" class="btn btn-sm btn-outline-danger rounded-pill">
                                    <i class="bi bi-flag"></i> Report Seller
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
