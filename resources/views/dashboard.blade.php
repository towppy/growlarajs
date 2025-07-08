@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-success">👋 Welcome back, {{ Auth::user()->name }}!</h2>

    @if ($isAdmin)
        <p class="mb-4">You are viewing the admin dashboard.</p>

        <div class="row g-4">
            <!-- Total Sales Chart -->
            <div class="col-md-4">
                <div class="card shadow-sm border-success">
                    <div class="card-body">
                        <h5 class="card-title text-success">💰 Total Sales</h5>
                        <canvas id="salesChart" height="150"></canvas>
                    </div>
                </div>
            </div>

            <!-- Users Logged In Chart -->
            <div class="col-md-4">
                <div class="card shadow-sm border-primary">
                    <div class="card-body">
                        <h5 class="card-title text-primary">👥 Users Logged In</h5>
                        <canvas id="usersChart" height="150"></canvas>
                    </div>
                </div>
            </div>

            <!-- Product Stocks Chart -->
            <div class="col-md-4">
                <div class="card shadow-sm border-warning">
                    <div class="card-body">
                        <h5 class="card-title text-warning">📦 Product Stocks</h5>
                        <canvas id="stocksChart" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>

    @else
        {{-- USER DASHBOARD --}}
        <p>Here's your activity summary:</p>

        <div class="card mt-4 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">📊 Your Purchases (Monthly)</h5>
                <canvas id="purchaseChart" height="100"></canvas>
            </div>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    @if (!$isAdmin)
    // USER CHART
    new Chart(document.getElementById('purchaseChart'), {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [{
                label: 'Items Purchased',
                data: [2, 5, 3, 7, 4],
                backgroundColor: 'rgba(34, 197, 94, 0.6)',
                borderColor: 'rgba(34, 197, 94, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: { y: { beginAtZero: true, stepSize: 1 } }
        }
    });
    @else
    // ADMIN CHARTS
    new Chart(document.getElementById('salesChart'), {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
            datasets: [{
                label: '₱ Sales',
                data: [4000, 5000, 3000, 6000, 2000],
                borderColor: 'rgba(34, 197, 94, 1)',
                backgroundColor: 'rgba(34, 197, 94, 0.2)',
                fill: true,
                tension: 0.3
            }]
        }
    });

    new Chart(document.getElementById('usersChart'), {
        type: 'bar',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
            datasets: [{
                label: 'Users Logged In',
                data: [5, 12, 8, 15, 10],
                backgroundColor: 'rgba(59, 130, 246, 0.6)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 1
            }]
        },
        options: { scales: { y: { beginAtZero: true } } }
    });

    new Chart(document.getElementById('stocksChart'), {
        type: 'doughnut',
        data: {
            labels: ['Available', 'Sold'],
            datasets: [{
                label: 'Product Stock',
                data: [120, 80],
                backgroundColor: ['rgba(255, 193, 7, 0.7)', 'rgba(255, 99, 132, 0.7)'],
                borderColor: ['rgba(255, 193, 7, 1)', 'rgba(255, 99, 132, 1)'],
                borderWidth: 1
            }]
        }
    });
    @endif
</script>
@endpush
