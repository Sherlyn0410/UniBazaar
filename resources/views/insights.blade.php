  <div class="container py-5">
        <h2 class="mb-4">📊 Sales Insights</h2>

        <div class="card p-3 mb-3">
            <h4>Total Money Earned:</h4>
            <p><strong>RM {{ number_format($totalMoney, 2) }}</strong></p>
        </div>

        <div class="card p-3">
            <h4>Total Products Sold:</h4>
            <p><strong>{{ $totalSold }}</strong> units</p>
        </div>
    </div>