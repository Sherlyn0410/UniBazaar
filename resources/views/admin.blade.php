@extends('layouts.admin-main')

@section('content')
    <h3 class="mb-4 fw-semibold">Dashboard</h3>

    <div class="row g-3">
        <div class="col-6 col-lg-3">
            <a href="{{ route('view.student') }}" class="text-decoration-none">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="bi bi-people-fill fs-1 text-primary"></i>
                        <div class="fw-semibold mt-2">Users</div>
                        <div class="fs-4">{{ \App\Models\Student::where('is_admin', false)->count() }}</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-lg-3">
            <a href="{{ route('view.product') }}" class="text-decoration-none">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="bi bi-box-seam fs-1 text-success"></i>
                        <div class="fw-semibold mt-2">Products</div>
                        <div class="fs-4">{{ \App\Models\Product::count() }}</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-lg-3">
            <a href="{{ route('view.order') }}" class="text-decoration-none">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="bi bi-cart-check fs-1 text-warning"></i>
                        <div class="fw-semibold mt-2">Orders</div>
                        <div class="fs-4">{{ \App\Models\Order::count() }}</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-lg-3">
            <a href="{{ route('admin.reports') }}" class="text-decoration-none">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="bi bi-flag fs-1 text-danger"></i>
                        <div class="fw-semibold mt-2">Reports</div>
                        <div class="fs-4">{{ \App\Models\Report::count() }}</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="my-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <canvas id="dashboardChart" height="300" style="min-width: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>

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
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
@endsection