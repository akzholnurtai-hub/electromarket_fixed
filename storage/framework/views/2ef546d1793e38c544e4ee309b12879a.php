<?php $__env->startSection('content'); ?>

<h2 class="mb-4 fw-bold text-center">📊 Analytics Dashboard</h2>

<?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>


<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card p-3 text-center bg-primary text-white">
            <h6>📦 <?php echo e(__('lang.total_orders')); ?></h6>
            <h3><?php echo e($totalOrders); ?></h3>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card p-3 text-center bg-warning">
            <h6>⏳ <?php echo e(__('lang.pending_orders')); ?></h6>
            <h3><?php echo e($pendingOrders); ?></h3>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card p-3 text-center bg-success text-white">
            <h6>💰 <?php echo e(__('lang.total_revenue')); ?></h6>
            <h3><?php echo e(number_format($totalRevenue, 0, '.', ' ')); ?></h3>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card p-3 text-center bg-dark text-white">
            <h6>🏷️ <?php echo e(__('lang.total_products')); ?></h6>
            <h3><?php echo e($totalProducts); ?></h3>
        </div>
    </div>
</div>

<div class="text-center mb-4">
    <a href="/admin/orders" class="btn btn-dark">
        📋 <?php echo e(__('lang.manage_orders')); ?>

    </a>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card p-4 shadow rounded-4">
            <h5 class="text-center">📱 <?php echo e(__('lang.product_popularity')); ?></h5>
            <canvas id="pieChart"></canvas>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card p-4 shadow rounded-4">
            <h5 class="text-center">💰 <?php echo e(__('lang.sales_by_year')); ?></h5>
            <canvas id="barChart"></canvas>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card p-4 shadow rounded-4">
            <h5 class="text-center">📈 <?php echo e(__('lang.monthly_growth')); ?></h5>
            <canvas id="lineChart"></canvas>
        </div>
    </div>
</div>

<?php endif; ?>

<?php if (\Illuminate\Support\Facades\Blade::check('role', 'manager|client|guest')): ?>
    <div class="alert alert-danger text-center">
        ❌ <?php echo e(__('lang.access_denied')); ?>

    </div>
<?php endif; ?>

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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\777\Downloads\electromarket_fixed_v2\electromarket_fixed\resources\views/analytics.blade.php ENDPATH**/ ?>