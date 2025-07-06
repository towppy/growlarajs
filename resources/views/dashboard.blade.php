@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-success">👋 Hey there, {{ Auth::user()->name }}!</h2>
    <p>Here's your activity summary:</p>

    <div class="card mt-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">📊 Your Purchases (Monthly)</h5>
            <canvas id="purchaseChart" height="100"></canvas>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('purchaseChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [{
                label: 'Items Purchased',
                data: [2, 5, 3, 7, 4], // Replace with real data if needed
                backgroundColor: 'rgba(34, 197, 94, 0.6)',
                borderColor: 'rgba(34, 197, 94, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    stepSize: 1
                }
            }
        }
    });
</script>
@endpush
