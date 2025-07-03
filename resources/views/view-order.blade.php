@extends('layouts.admin-main')
 
@section('content')
    <h3 class="mb-4 fw-semibold">Order List (Admin)</h3>
    @if($orders->isEmpty())
        <div class="alert alert-info">No orders found.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered align-top shadow-sm rounded-4 overflow-hidden mx-auto" style="background: #fff;">
                <thead class="table-secondary align-top">
                    <tr>
                        <th class="text-center">#</th>
                        <th>Product</th>
                        <th>Buyer</th>
                        <th>Seller</th>
                        <th>Quantity</th>
                        <th>Total (RM)</th>
                        <th>Ordered At</th>
                    </tr>
                </thead>
                <tbody class="align-top">
                    @foreach ($orders as $index => $order)
                        <tr>
                            <td class="text-center fw-semibold">{{ $index + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-start gap-2">
                                    @if(!empty($order->product->product_image) && file_exists(public_path('assets/img/' . $order->product->product_image)))
                                        <img src="{{ asset('assets/img/' . $order->product->product_image) }}"
                                             alt="{{ $order->product->product_name }}"
                                             class="rounded shadow-sm"
                                             style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                        <span class="bg-secondary text-white rounded d-flex justify-content-center align-items-center"
                                              style="width:40px; height:40px;">
                                            <i class="bi bi-image"></i>
                                        </span>
                                    @endif
                                    <span class="fw-semibold">{{ $order->product->product_name }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if(!empty($order->buyer->profile_image) && file_exists(public_path('assets/img/' . $order->buyer->profile_image)))
                                        <img src="{{ asset('assets/img/' . $order->buyer->profile_image) }}"
                                             alt="{{ $order->buyer->name }}"
                                             class="rounded-circle shadow-sm"
                                             style="width: 32px; height: 32px; object-fit: cover;">
                                    @else
                                        <span class="bg-secondary text-white rounded-circle d-flex justify-content-center align-items-center"
                                              style="width:32px; height:32px;">
                                            <i class="bi bi-person"></i>
                                        </span>
                                    @endif
                                    <span>{{ $order->buyer->name }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if(!empty($order->product->student->profile_image) && file_exists(public_path('assets/img/' . $order->product->student->profile_image)))
                                        <img src="{{ asset('assets/img/' . $order->product->student->profile_image) }}"
                                             alt="{{ $order->product->student->name }}"
                                             class="rounded-circle shadow-sm"
                                             style="width: 32px; height: 32px; object-fit: cover;">
                                    @else
                                        <span class="bg-secondary text-white rounded-circle d-flex justify-content-center align-items-center"
                                              style="width:32px; height:32px;">
                                            <i class="bi bi-person"></i>
                                        </span>
                                    @endif
                                    <span>{{ $order->product->student->name }}</span>
                                </div>
                            </td>
                            <td>{{ $order->quantity }}</td>
                            <td>RM {{ number_format($order->product->product_price * $order->quantity, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->ordered_at)->format('d M Y, h:i A') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

@endsection
