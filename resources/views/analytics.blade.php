@extends('layout')

@section('content')

<h2 class="mb-4 fw-bold text-center">📊 Analytics Dashboard</h2>

@role('admin')

{{-- Жалпы статистика карточкалары --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card p-3 text-center bg-primary text-white">
            <h6>📦 {{ __('lang.total_orders') }}</h6>
            <h3>{{ $totalOrders }}</h3>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card p-3 text-center bg-warning">
            <h6>⏳ {{ __('lang.pending_orders') }}</h6>
            <h3>{{ $pendingOrders }}</h3>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card p-3 text-center bg-success text-white">
            <h6>💰 {{ __('lang.total_revenue') }}</h6>
            <h3>{{ number_format($totalRevenue, 0, '.', ' ') }}</h3>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card p-3 text-center bg-dark text-white">
            <h6>🏷️ {{ __('lang.total_products') }}</h6>
            <h3>{{ $totalProducts }}</h3>
        </div>
    </div>
</div>

<div class="text-center mb-4">
    <a href="/admin/orders" class="btn btn-dark">
        📋 {{ __('lang.manage_orders') }}
    </a>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card p-4 shadow rounded-4">
            <h5 class="text-center">📱 {{ __('lang.product_popularity') }}</h5>
            <canvas id="pieChart"></canvas>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card p-4 shadow rounded-4">
            <h5 class="text-center">💰 {{ __('lang.sales_by_year') }}</h5>
            <canvas id="barChart"></canvas>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card p-4 shadow rounded-4">
            <h5 class="text-center">📈 {{ __('lang.monthly_growth') }}</h5>
            <canvas id="lineChart"></canvas>
        </div>
    </div>
</div>

@endrole

@role('manager|client|guest')
    <div class="alert alert-danger text-center">
        ❌ {{ __('lang.access_denied') }}
    </div>
@endrole

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('pieChart'), {
    type: 'pie',
    data: {
        labels: ['Smartphones', 'Laptops', 'Headphones', 'Watches'],
        datasets: [{ data: [40, 25, 20, 15] }]
    }
});

new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
        labels: ['2021','2022','2023','2024','2025','2026'],
        datasets: [{ label: 'Sales (KZT mln)', data: [120, 200, 300, 280, 350, 450] }]
    }
});

new Chart(document.getElementById('lineChart'), {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul'],
        datasets: [{ label: 'Users Growth', data: [10, 30, 50, 40, 70, 90, 120], fill: false }]
    }
});
</script>

@endsection
