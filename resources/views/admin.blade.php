@extends('layouts.admin-main')

@section('content')
    <h3 class="mb-4 fw-semibold">Dashboard</h3>

    <div class="row g-4">
        <div class="col-md-3 col-6">
            <a href="{{ route('view.student') }}" class="text-decoration-none text-dark">
                <div class="card shadow-sm border-0 text-center position-relative h-100">
                    <div class="card-body">
                        <div class="mb-2">
                            <i class="bi bi-people-fill fs-1 text-primary"></i>
                        </div>
                        <h5 class="card-title mb-1">Users</h5>
                        <div class="fs-3 fw-bold">
                            {{ \App\Models\Student::where('is_admin', false)->count() }}
                        </div>
                        <span class="stretched-link"></span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-6">
            <a href="{{ route('view.product') }}" class="text-decoration-none text-dark">
                <div class="card shadow-sm border-0 text-center position-relative h-100">
                    <div class="card-body">
                        <div class="mb-2">
                            <i class="bi bi-box-seam fs-1 text-success"></i>
                        </div>
                        <h5 class="card-title mb-1">Products</h5>
                        <div class="fs-3 fw-bold">{{ \App\Models\Product::count() }}</div>
                        <span class="stretched-link"></span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-6">
            <a href="{{ route('view.order') }}" class="text-decoration-none text-dark">
                <div class="card shadow-sm border-0 text-center position-relative h-100">
                    <div class="card-body">
                        <div class="mb-2">
                            <i class="bi bi-cart-check fs-1 text-warning"></i>
                        </div>
                        <h5 class="card-title mb-1">Orders</h5>
                        <div class="fs-3 fw-bold">{{ \App\Models\Order::count() }}</div>
                        <span class="stretched-link"></span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-6">
            <a href="{{ route('admin.reports') }}" class="text-decoration-none text-dark">
                <div class="card shadow-sm border-0 text-center position-relative h-100">
                    <div class="card-body">
                        <div class="mb-2">
                            <i class="bi bi-flag fs-1 text-danger"></i>
                        </div>
                        <h5 class="card-title mb-1">Reports</h5>
                        <div class="fs-3 fw-bold">{{ \App\Models\Report::count() }}</div>
                        <span class="stretched-link"></span>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <canvas id="dashboardChart" height="120"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('dashboardChart').getContext('2d');
        const dashboardChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Students', 'Products', 'Orders', 'Reports'],
                datasets: [{
                    label: 'Total',
                    data: [
                        {{ \App\Models\Student::where('is_admin', false)->count() }},
                        {{ \App\Models\Product::count() }},
                        {{ \App\Models\Order::count() }},
                        {{ \App\Models\Report::count() }}
                    ],
                    backgroundColor: [
                        'rgba(13,110,253,0.5)',
                        'rgba(25,135,84,0.5)',
                        'rgba(255,193,7,0.5)',
                        'rgba(220,53,69,0.5)'
                    ],
                    borderColor: [
                        'rgba(13,110,253,1)',
                        'rgba(25,135,84,1)',
                        'rgba(255,193,7,1)',
                        'rgba(220,53,69,1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
@endsection