@extends('layouts.admin-main')

@section('content')
    <h3 class="fw-semibold mb-4">Reported Sellers</h3>

    @if ($reports->isEmpty())
        <div class="alert alert-info">No reports submitted.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-dark text-center">
                <tr>
                    <th>#</th>
                    <th>Buyer</th>
                    <th>Seller</th>
                    <th>Product</th>
                    <th>Reason</th>
                    <th>Reported At</th>
                    <th>Ban Seller</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $index => $report)
                    <tr class="text-center align-middle">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $report->buyer->name ?? 'N/A' }}</td>
                        <td>{{ $report->seller->name ?? 'N/A' }}</td>
                        <td>{{ $report->order->product->product_name ?? 'N/A' }}</td>
                        <td class="text-start">{{ $report->reason }}</td>
                        <td>{{ $report->created_at->format('d M Y, h:i A') }}</td>
                        <td>
                            <form action="{{ route('admin.student.delete', $report->seller->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to ban this seller?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Ban Seller</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
